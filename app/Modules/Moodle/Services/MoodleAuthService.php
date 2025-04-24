<?php

namespace App\Modules\Moodle\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Exception;

class MoodleAuthService
{
    /**
     * The MoodleApiService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleApiService
     */
    protected $apiService;

    /**
     * The Moodle API base URL
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * Create a new MoodleAuthService instance.
     *
     * @param \App\Modules\Moodle\Services\MoodleApiService $apiService
     * @return void
     */
    public function __construct(MoodleApiService $apiService)
    {
        $this->apiService = $apiService;
        $this->baseUrl = config('moodle.connection.url');
    }

    /**
     * Generate a token for a user
     *
     * @param string $username The username
     * @param string $password The password
     * @param string $service The service shortname
     * @return array
     * @throws Exception
     */
    public function generateToken($username, $password, $service = 'moodle_mobile_app')
    {
        try {
            $url = "{$this->baseUrl}/login/token.php";
            
            $response = Http::asForm()->post($url, [
                'username' => $username,
                'password' => $password,
                'service' => $service
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['error'])) {
                    throw new Exception("Moodle token generation error: {$data['error']}");
                }
                
                return $data;
            }
            
            throw new Exception("HTTP Error: {$response->status()} - {$response->body()}");
        } catch (Exception $e) {
            Log::error("Moodle Token Generation Error: {$e->getMessage()}", [
                'username' => $username,
                'service' => $service,
                'exception' => $e
            ]);
            
            throw new Exception("Error generating Moodle token: {$e->getMessage()}");
        }
    }

    /**
     * Validate a token
     *
     * @param string $token The token to validate
     * @return bool
     */
    public function validateToken($token)
    {
        try {
            // Use the token to make a simple API call
            $url = $this->baseUrl . '/webservice/rest/server.php';
            
            $response = Http::asForm()->post($url, [
                'wstoken' => $token,
                'wsfunction' => 'core_webservice_get_site_info',
                'moodlewsrestformat' => 'json'
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                return !isset($data['exception']);
            }
            
            return false;
        } catch (Exception $e) {
            Log::error("Moodle Token Validation Error: {$e->getMessage()}", [
                'exception' => $e
            ]);
            
            return false;
        }
    }

    /**
     * Get user information using the token
     *
     * @param string $token The user's token
     * @return array|null
     */
    public function getUserInfo($token = null)
    {
        try {
            $token = $token ?? config('moodle.connection.token');
            
            $url = $this->baseUrl . '/webservice/rest/server.php';
            
            $response = Http::asForm()->post($url, [
                'wstoken' => $token,
                'wsfunction' => 'core_webservice_get_site_info',
                'moodlewsrestformat' => 'json'
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['exception'])) {
                    throw new Exception($data['message'] ?? 'Unknown Moodle API error');
                }
                
                return $data;
            }
            
            throw new Exception("HTTP Error: {$response->status()} - {$response->body()}");
        } catch (Exception $e) {
            Log::error("Moodle Get User Info Error: {$e->getMessage()}", [
                'exception' => $e
            ]);
            
            return null;
        }
    }

    /**
     * Check if the current token has the required capabilities
     *
     * @param array $capabilities Array of capability names to check
     * @param int $userId User ID to check capabilities for (0 for current user)
     * @param int $contextId Context ID to check capabilities in
     * @return bool
     */
    public function hasCapabilities(array $capabilities, $userId = 0, $contextId = 1)
    {
        try {
            $params = [
                'capabilities' => $capabilities,
                'contextid' => $contextId
            ];
            
            if ($userId > 0) {
                $params['userid'] = $userId;
            }
            
            $result = $this->apiService->call('core_webservice_get_site_info', $params);
            
            // Check if all capabilities are allowed
            foreach ($capabilities as $capability) {
                if (!isset($result[$capability]) || !$result[$capability]) {
                    return false;
                }
            }
            
            return true;
        } catch (Exception $e) {
            Log::error("Moodle Capability Check Error: {$e->getMessage()}", [
                'capabilities' => $capabilities,
                'userId' => $userId,
                'contextId' => $contextId,
                'exception' => $e
            ]);
            
            return false;
        }
    }
}
