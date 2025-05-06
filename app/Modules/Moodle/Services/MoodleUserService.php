<?php

namespace App\Modules\Moodle\Services;

use Illuminate\Support\Facades\Log;
use Exception;

class MoodleUserService
{
    /**
     * The MoodleApiService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleApiService
     */
    protected $apiService;

    /**
     * Create a new MoodleUserService instance.
     *
     * @param \App\Modules\Moodle\Services\MoodleApiService $apiService
     * @return void
     */
    public function __construct(MoodleApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Create a new user in Moodle
     *
     * @param array $userData User data
     * @return array|null
     */
    public function createUser(array $userData)
    {
        try {
            // Required fields for Moodle user creation
            $requiredFields = ['username', 'password', 'firstname', 'lastname', 'email'];

            foreach ($requiredFields as $field) {
                if (!isset($userData[$field]) || empty($userData[$field])) {
                    throw new Exception("Missing required field: {$field}");
                }
            }

            // Prepare user data for Moodle API
            $user = [
                'username' => $userData['username'],
                'password' => $userData['password'],
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'],
                'email' => $userData['email'],
                'auth' => $userData['auth'] ?? 'manual',
                'idnumber' => $userData['idnumber'] ?? '',
                'lang' => $userData['lang'] ?? 'es',
                'calendartype' => $userData['calendartype'] ?? 'gregorian',
                'theme' => $userData['theme'] ?? '',
                'timezone' => $userData['timezone'] ?? '99',
                'mailformat' => $userData['mailformat'] ?? 1,
                'description' => $userData['description'] ?? '',
                'city' => $userData['city'] ?? '',
                'country' => $userData['country'] ?? '',
                'preferences' => $userData['preferences'] ?? [],
            ];

            // Call Moodle API to create user
            $response = $this->apiService->call('core_user_create_users', [
                'users' => [$user]
            ]);

            if (is_array($response) && !empty($response)) {
                return $response[0];
            }

            return null;
        } catch (Exception $e) {
            Log::error("Moodle Create User Error: {$e->getMessage()}", [
                'userData' => $userData,
                'exception' => $e
            ]);

            throw new Exception("Error creating Moodle user: {$e->getMessage()}");
        }
    }

    /**
     * Update an existing user in Moodle
     *
     * @param int $userId Moodle user ID
     * @param array $userData User data to update
     * @return bool
     */
    public function updateUser($userId, array $userData)
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }

            // Prepare user data for Moodle API
            $user = array_merge(['id' => $userId], $userData);

            // Call Moodle API to update user
            $this->apiService->call('core_user_update_users', [
                'users' => [$user]
            ]);

            return true;
        } catch (Exception $e) {
            Log::error("Moodle Update User Error: {$e->getMessage()}", [
                'userId' => $userId,
                'userData' => $userData,
                'exception' => $e
            ]);

            throw new Exception("Error updating Moodle user: {$e->getMessage()}");
        }
    }

    /**
     * Delete a user in Moodle
     *
     * @param int $userId Moodle user ID
     * @return bool
     */
    public function deleteUser($userId)
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }

            // Call Moodle API to delete user
            $this->apiService->call('core_user_delete_users', [
                'userids' => [$userId]
            ]);

            return true;
        } catch (Exception $e) {
            Log::error("Moodle Delete User Error: {$e->getMessage()}", [
                'userId' => $userId,
                'exception' => $e
            ]);

            throw new Exception("Error deleting Moodle user: {$e->getMessage()}");
        }
    }

    /**
     * Get a user by ID from Moodle
     *
     * @param int $userId Moodle user ID
     * @return array|null
     */
    public function getUser($userId)
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }

            // Call Moodle API to get user
            $response = $this->apiService->call('core_user_get_users', [
                'criteria' => [
                    [
                        'key' => 'id',
                        'value' => $userId
                    ]
                ]
            ]);

            if (isset($response['users']) && !empty($response['users'])) {
                return $response['users'][0];
            }

            return null;
        } catch (Exception $e) {
            Log::error("Moodle Get User Error: {$e->getMessage()}", [
                'userId' => $userId,
                'exception' => $e
            ]);

            throw new Exception("Error getting Moodle user: {$e->getMessage()}");
        }
    }

    /**
     * Get a user by username from Moodle
     *
     * @param string $username Moodle username
     * @return array|null
     */
    public function getUserByUsername($username)
    {
        try {
            if (!$username) {
                throw new Exception("Username is required");
            }

            // Call Moodle API to get user
            $response = $this->apiService->call('core_user_get_users', [
                'criteria' => [
                    [
                        'key' => 'username',
                        'value' => $username
                    ]
                ]
            ]);

            if (isset($response['users']) && !empty($response['users'])) {
                return $response['users'][0];
            }

            return null;
        } catch (Exception $e) {
            Log::error("Moodle Get User By Username Error: {$e->getMessage()}", [
                'username' => $username,
                'exception' => $e
            ]);

            throw new Exception("Error getting Moodle user by username: {$e->getMessage()}");
        }
    }

    /**
     * Get a user by email from Moodle
     *
     * @param string $email User email
     * @return array|null
     */
    public function getUserByEmail($email)
    {
        try {
            if (!$email) {
                throw new Exception("Email is required");
            }

            // Call Moodle API to get user
            $response = $this->apiService->call('core_user_get_users', [
                'criteria' => [
                    [
                        'key' => 'email',
                        'value' => $email
                    ]
                ]
            ]);

            if (isset($response['users']) && !empty($response['users'])) {
                return $response['users'][0];
            }

            return null;
        } catch (Exception $e) {
            Log::error("Moodle Get User By Email Error: {$e->getMessage()}", [
                'email' => $email,
                'exception' => $e
            ]);

            throw new Exception("Error getting Moodle user by email: {$e->getMessage()}");
        }
    }

    /**
     * Get user preferences
     *
     * @param int $userId Moodle user ID
     * @return array
     */
    public function getUserPreferences($userId)
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }

            // Call Moodle API to get user preferences
            $response = $this->apiService->call('core_user_get_user_preferences', [
                'userid' => $userId
            ]);

            if (isset($response['preferences'])) {
                return $response['preferences'];
            }

            return [];
        } catch (Exception $e) {
            Log::error("Moodle Get User Preferences Error: {$e->getMessage()}", [
                'userId' => $userId,
                'exception' => $e
            ]);

            throw new Exception("Error getting Moodle user preferences: {$e->getMessage()}");
        }
    }

    /**
     * Set user preferences
     *
     * @param int $userId Moodle user ID
     * @param array $preferences Array of preferences (name => value)
     * @return bool
     */
    public function setUserPreferences($userId, array $preferences)
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }

            if (empty($preferences)) {
                throw new Exception("Preferences array cannot be empty");
            }

            // Format preferences for Moodle API
            $formattedPreferences = [];
            foreach ($preferences as $name => $value) {
                $formattedPreferences[] = [
                    'name' => $name,
                    'value' => $value,
                    'userid' => $userId
                ];
            }

            // Call Moodle API to set user preferences
            $this->apiService->call('core_user_set_user_preferences', [
                'preferences' => $formattedPreferences
            ]);

            return true;
        } catch (Exception $e) {
            Log::error("Moodle Set User Preferences Error: {$e->getMessage()}", [
                'userId' => $userId,
                'preferences' => $preferences,
                'exception' => $e
            ]);

            throw new Exception("Error setting Moodle user preferences: {$e->getMessage()}");
        }
    }
    /**
     * Search users in Moodle using an array of criteria
     *
     * @param array $criteria Array of search criteria, e.g.:
     *                        [['key' => 'email', 'value' => 'example@domain.com']]
     * @return array
     * @throws Exception
     */
    public function searchUsers(array $criteria): array
    {
        try {
            // Si no se pasan criterios, usamos comodín para obtener todos
            if (empty($criteria)) {
                $criteria = [
                    ['key' => 'id', 'value' => '%']
                ];
            }

            $response = $this->apiService->call('core_user_get_users', [
                'criteria' => $criteria
            ]);

            return $response['users'] ?? [];
        } catch (Exception $e) {
            Log::error("Moodle Search Users Error: {$e->getMessage()}", [
                'criteria' => $criteria,
                'exception' => $e
            ]);

            throw new Exception("Error searching Moodle users: {$e->getMessage()}");
        }
    }

}
