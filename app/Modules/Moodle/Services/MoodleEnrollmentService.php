<?php

namespace App\Modules\Moodle\Services;

use Illuminate\Support\Facades\Log;
use Exception;

class MoodleEnrollmentService
{
    /**
     * The MoodleApiService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleApiService
     */
    protected $apiService;

    /**
     * Create a new MoodleEnrollmentService instance.
     *
     * @param \App\Modules\Moodle\Services\MoodleApiService $apiService
     * @return void
     */
    public function __construct(MoodleApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Enroll a user in a course
     *
     * @param int $userId Moodle user ID
     * @param int $courseId Moodle course ID
     * @param int $roleId Role ID (default: student role)
     * @param string $enrolMethod Enrollment method (default: manual)
     * @return bool
     */
    public function enrollUser($userId, $courseId, $roleId = 5, $enrolMethod = 'manual')
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Call Moodle API to enroll user
            $this->apiService->call('enrol_manual_enrol_users', [
                'enrolments' => [
                    [
                        'roleid' => $roleId,
                        'userid' => $userId,
                        'courseid' => $courseId,
                    ]
                ]
            ]);
            
            return true;
        } catch (Exception $e) {
            Log::error("Moodle Enroll User Error: {$e->getMessage()}", [
                'userId' => $userId,
                'courseId' => $courseId,
                'roleId' => $roleId,
                'enrolMethod' => $enrolMethod,
                'exception' => $e
            ]);
            
            throw new Exception("Error enrolling user in Moodle course: {$e->getMessage()}");
        }
    }

    /**
     * Unenroll a user from a course
     *
     * @param int $userId Moodle user ID
     * @param int $courseId Moodle course ID
     * @param string $enrolMethod Enrollment method (default: manual)
     * @return bool
     */
    public function unenrollUser($userId, $courseId, $enrolMethod = 'manual')
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Call Moodle API to unenroll user
            $this->apiService->call('enrol_manual_unenrol_users', [
                'enrolments' => [
                    [
                        'userid' => $userId,
                        'courseid' => $courseId,
                    ]
                ]
            ]);
            
            return true;
        } catch (Exception $e) {
            Log::error("Moodle Unenroll User Error: {$e->getMessage()}", [
                'userId' => $userId,
                'courseId' => $courseId,
                'enrolMethod' => $enrolMethod,
                'exception' => $e
            ]);
            
            throw new Exception("Error unenrolling user from Moodle course: {$e->getMessage()}");
        }
    }

    /**
     * Get enrolled users in a course
     *
     * @param int $courseId Moodle course ID
     * @return array
     */
    public function getEnrolledUsers($courseId)
    {
        try {
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Call Moodle API to get enrolled users
            $response = $this->apiService->call('core_enrol_get_enrolled_users', [
                'courseid' => $courseId
            ]);
            
            return $response;
        } catch (Exception $e) {
            Log::error("Moodle Get Enrolled Users Error: {$e->getMessage()}", [
                'courseId' => $courseId,
                'exception' => $e
            ]);
            
            throw new Exception("Error getting enrolled users in Moodle course: {$e->getMessage()}");
        }
    }

    /**
     * Get available enrollment methods for a course
     *
     * @param int $courseId Moodle course ID
     * @return array
     */
    public function getEnrollmentMethods($courseId)
    {
        try {
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Call Moodle API to get enrollment methods
            $response = $this->apiService->call('core_enrol_get_course_enrolment_methods', [
                'courseid' => $courseId
            ]);
            
            return $response;
        } catch (Exception $e) {
            Log::error("Moodle Get Enrollment Methods Error: {$e->getMessage()}", [
                'courseId' => $courseId,
                'exception' => $e
            ]);
            
            throw new Exception("Error getting enrollment methods for Moodle course: {$e->getMessage()}");
        }
    }

    /**
     * Get user enrollments
     *
     * @param int $userId Moodle user ID
     * @return array
     */
    public function getUserEnrollments($userId)
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            // Call Moodle API to get user enrollments
            $response = $this->apiService->call('core_enrol_get_users_courses', [
                'userid' => $userId
            ]);
            
            return $response;
        } catch (Exception $e) {
            Log::error("Moodle Get User Enrollments Error: {$e->getMessage()}", [
                'userId' => $userId,
                'exception' => $e
            ]);
            
            throw new Exception("Error getting user enrollments in Moodle: {$e->getMessage()}");
        }
    }

    /**
     * Check if a user is enrolled in a course
     *
     * @param int $userId Moodle user ID
     * @param int $courseId Moodle course ID
     * @return bool
     */
    public function isUserEnrolled($userId, $courseId)
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Get user enrollments
            $enrollments = $this->getUserEnrollments($userId);
            
            // Check if user is enrolled in the specified course
            foreach ($enrollments as $enrollment) {
                if ($enrollment['id'] == $courseId) {
                    return true;
                }
            }
            
            return false;
        } catch (Exception $e) {
            Log::error("Moodle Check User Enrollment Error: {$e->getMessage()}", [
                'userId' => $userId,
                'courseId' => $courseId,
                'exception' => $e
            ]);
            
            throw new Exception("Error checking user enrollment in Moodle course: {$e->getMessage()}");
        }
    }

    /**
     * Enroll a user in a course after payment
     *
     * @param int $userId Moodle user ID
     * @param int $courseId Moodle course ID
     * @param array $paymentData Payment data
     * @return bool
     */
    public function enrollAfterPayment($userId, $courseId, array $paymentData = [])
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Enroll user in course
            $this->enrollUser($userId, $courseId);
            
            // Log payment information
            Log::info("User enrolled after payment", [
                'userId' => $userId,
                'courseId' => $courseId,
                'paymentData' => $paymentData
            ]);
            
            return true;
        } catch (Exception $e) {
            Log::error("Moodle Enroll After Payment Error: {$e->getMessage()}", [
                'userId' => $userId,
                'courseId' => $courseId,
                'paymentData' => $paymentData,
                'exception' => $e
            ]);
            
            throw new Exception("Error enrolling user after payment: {$e->getMessage()}");
        }
    }

    /**
     * Get available roles
     *
     * @return array
     */
    public function getRoles()
    {
        try {
            // Call Moodle API to get roles
            $response = $this->apiService->call('core_role_get_all_roles');
            
            return $response['roles'] ?? [];
        } catch (Exception $e) {
            Log::error("Moodle Get Roles Error: {$e->getMessage()}", [
                'exception' => $e
            ]);
            
            throw new Exception("Error getting Moodle roles: {$e->getMessage()}");
        }
    }

    /**
     * Assign a role to a user in a context
     *
     * @param int $userId Moodle user ID
     * @param int $roleId Role ID
     * @param int $contextId Context ID
     * @return bool
     */
    public function assignRole($userId, $roleId, $contextId)
    {
        try {
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            if (!$roleId) {
                throw new Exception("Role ID is required");
            }
            
            if (!$contextId) {
                throw new Exception("Context ID is required");
            }
            
            // Call Moodle API to assign role
            $this->apiService->call('core_role_assign_roles', [
                'assignments' => [
                    [
                        'roleid' => $roleId,
                        'userid' => $userId,
                        'contextid' => $contextId
                    ]
                ]
            ]);
            
            return true;
        } catch (Exception $e) {
            Log::error("Moodle Assign Role Error: {$e->getMessage()}", [
                'userId' => $userId,
                'roleId' => $roleId,
                'contextId' => $contextId,
                'exception' => $e
            ]);
            
            throw new Exception("Error assigning role in Moodle: {$e->getMessage()}");
        }
    }
}
