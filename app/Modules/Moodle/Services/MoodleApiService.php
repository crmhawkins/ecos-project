<?php

namespace App\Modules\Moodle\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Exception;

class MoodleApiService
{
    /**
     * The Moodle API base URL
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * The Moodle API token
     *
     * @var string
     */
    protected $token;

    /**
     * The API protocol (rest, soap, etc)
     *
     * @var string
     */
    protected $protocol;

    /**
     * The response format (json, xml)
     *
     * @var string
     */
    protected $format;

    /**
     * Request timeout in seconds
     *
     * @var int
     */
    protected $timeout;

    /**
     * Whether to use cache
     *
     * @var bool
     */
    protected $useCache;

    /**
     * Cache TTL in seconds
     *
     * @var int
     */
    protected $cacheTtl;

    /**
     * Create a new MoodleApiService instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseUrl = config('moodle.connection.url');
        $this->token = config('moodle.connection.token');
        $this->protocol = config('moodle.connection.protocol', 'rest');
        $this->format = config('moodle.connection.format', 'json');
        $this->timeout = config('moodle.timeout', 60); // Aumentado de 30 a 60 segundos
        $this->useCache = config('moodle.cache.enabled', true);
        $this->cacheTtl = config('moodle.cache.ttl', 3600);
    }

    /**
     * Get the endpoint URL for the specified protocol
     *
     * @return string
     */
    protected function getEndpointUrl()
    {
            $cleanBase = rtrim($this->baseUrl, '/');
            switch ($this->protocol) {
                case 'rest':
                    return "{$cleanBase}/webservice/rest/server.php";
                case 'soap':
                    return "{$cleanBase}/webservice/soap/server.php";
                case 'xmlrpc':
                    return "{$cleanBase}/webservice/xmlrpc/server.php";
                default:
                    return "{$cleanBase}/webservice/rest/server.php";
            }
    }

    /**
     * Call a Moodle API function
     *
     * @param string $function The function name to call
     * @param array $params Additional parameters for the function
     * @param bool $forceRefresh Whether to force refresh the cache
     * @return mixed
     * @throws Exception
     */
    public function call($function, array $params = [], $forceRefresh = false)
    {
        $cacheKey = "moodle_api_{$function}_" . md5(json_encode($params));

        // Return cached response if available and cache is enabled
        if ($this->useCache && !$forceRefresh && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $response = $this->makeRequest($function, $params);

            // Cache the response if caching is enabled
            if ($this->useCache) {
                Cache::put($cacheKey, $response, $this->cacheTtl);
            }

            return $response;
        } catch (Exception $e) {
            Log::error("Moodle API Error: {$e->getMessage()}", [
                'function' => $function,
                'params' => $params,
                'exception' => $e
            ]);

            throw new Exception("Error calling Moodle API function '{$function}': {$e->getMessage()}");
        }
    }

    /**
     * Make the actual HTTP request to the Moodle API
     *
     * @param string $function The function name to call
     * @param array $params Additional parameters for the function
     * @return mixed
     * @throws Exception
     */
    protected function makeRequest($function, array $params = [])
    {
        $url = $this->getEndpointUrl();

        $requestParams = [
            'wstoken' => $this->token,
            'wsfunction' => $function,
            'moodlewsrestformat' => $this->format,
        ];

        $requestParams = array_merge($requestParams, $params);

        // Usar un timeout más largo para funciones que pueden tardar más
        $timeout = $this->timeout;
        if ($function === 'core_user_get_users') {
            $timeout = 120; // 2 minutos para la función de usuarios
        } elseif ($function === 'core_enrol_get_enrolled_users') {
            $timeout = 90; // 1.5 minutos para obtener usuarios matriculados
        }

        $response = Http::timeout($timeout)
            ->asForm()
            ->post($url, $requestParams);

        if ($response->successful()) {
            $data = $response->json();

            // Check for Moodle API error
            if (isset($data['exception'])) {
                throw new Exception($data['message'] ?? 'Unknown Moodle API error');
            }

            return $data;
        }

        throw new Exception("HTTP Error: {$response->status()} - {$response->body()}");
    }

    /**
     * Clear the cache for a specific function call
     *
     * @param string $function The function name
     * @param array $params The parameters used in the call
     * @return bool
     */
    public function clearCache($function, array $params = [])
    {
        $cacheKey = "moodle_api_{$function}_" . md5(json_encode($params));
        return Cache::forget($cacheKey);
    }

    /**
     * Clear all Moodle API cache
     *
     * @return bool
     */
    public function clearAllCache()
    {
        return Cache::flush();
    }

    /**
     * Test the connection to the Moodle API
     *
     * @return bool
     */
    public function testConnection()
    {
        try {
            // Call core_webservice_get_site_info which is a simple function to test connectivity
            $response = $this->call('core_webservice_get_site_info');
            return isset($response['sitename']);
        } catch (Exception $e) {
            Log::error("Moodle API Connection Test Failed: {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Get the Moodle site information
     *
     * @return array
     */
    public function getSiteInfo()
    {
        return $this->call('core_webservice_get_site_info');
    }
}
