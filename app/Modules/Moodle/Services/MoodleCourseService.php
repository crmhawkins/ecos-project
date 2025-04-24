<?php

namespace App\Modules\Moodle\Services;

use Illuminate\Support\Facades\Log;
use Exception;

class MoodleCourseService
{
    /**
     * The MoodleApiService instance
     *
     * @var \App\Modules\Moodle\Services\MoodleApiService
     */
    protected $apiService;

    /**
     * Create a new MoodleCourseService instance.
     *
     * @param \App\Modules\Moodle\Services\MoodleApiService $apiService
     * @return void
     */
    public function __construct(MoodleApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Get all courses from Moodle
     *
     * @return array
     */
    public function getAllCourses()
    {
        try {
            // Call Moodle API to get all courses
            $response = $this->apiService->call('core_course_get_courses');
            
            return $response;
        } catch (Exception $e) {
            Log::error("Moodle Get All Courses Error: {$e->getMessage()}", [
                'exception' => $e
            ]);
            
            throw new Exception("Error getting all Moodle courses: {$e->getMessage()}");
        }
    }

    /**
     * Get a course by ID from Moodle
     *
     * @param int $courseId Moodle course ID
     * @return array|null
     */
    public function getCourse($courseId)
    {
        try {
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Call Moodle API to get course
            $response = $this->apiService->call('core_course_get_courses', [
                'options' => [
                    'ids' => [$courseId]
                ]
            ]);
            
            if (is_array($response) && !empty($response)) {
                return $response[0];
            }
            
            return null;
        } catch (Exception $e) {
            Log::error("Moodle Get Course Error: {$e->getMessage()}", [
                'courseId' => $courseId,
                'exception' => $e
            ]);
            
            throw new Exception("Error getting Moodle course: {$e->getMessage()}");
        }
    }

    /**
     * Get course contents
     *
     * @param int $courseId Moodle course ID
     * @return array
     */
    public function getCourseContents($courseId)
    {
        try {
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Call Moodle API to get course contents
            $response = $this->apiService->call('core_course_get_contents', [
                'courseid' => $courseId
            ]);
            
            return $response;
        } catch (Exception $e) {
            Log::error("Moodle Get Course Contents Error: {$e->getMessage()}", [
                'courseId' => $courseId,
                'exception' => $e
            ]);
            
            throw new Exception("Error getting Moodle course contents: {$e->getMessage()}");
        }
    }

    /**
     * Create a new course in Moodle
     *
     * @param array $courseData Course data
     * @return array|null
     */
    public function createCourse(array $courseData)
    {
        try {
            // Required fields for Moodle course creation
            $requiredFields = ['fullname', 'shortname', 'categoryid'];
            
            foreach ($requiredFields as $field) {
                if (!isset($courseData[$field]) || empty($courseData[$field])) {
                    throw new Exception("Missing required field: {$field}");
                }
            }
            
            // Prepare course data for Moodle API
            $course = [
                'fullname' => $courseData['fullname'],
                'shortname' => $courseData['shortname'],
                'categoryid' => $courseData['categoryid'],
                'idnumber' => $courseData['idnumber'] ?? '',
                'summary' => $courseData['summary'] ?? '',
                'summaryformat' => $courseData['summaryformat'] ?? 1,
                'format' => $courseData['format'] ?? 'topics',
                'showgrades' => $courseData['showgrades'] ?? 1,
                'newsitems' => $courseData['newsitems'] ?? 5,
                'startdate' => $courseData['startdate'] ?? time(),
                'enddate' => $courseData['enddate'] ?? 0,
                'numsections' => $courseData['numsections'] ?? 10,
                'maxbytes' => $courseData['maxbytes'] ?? 0,
                'showreports' => $courseData['showreports'] ?? 0,
                'visible' => $courseData['visible'] ?? 1,
                'groupmode' => $courseData['groupmode'] ?? 0,
                'groupmodeforce' => $courseData['groupmodeforce'] ?? 0,
                'defaultgroupingid' => $courseData['defaultgroupingid'] ?? 0,
                'enablecompletion' => $courseData['enablecompletion'] ?? 1,
                'completionnotify' => $courseData['completionnotify'] ?? 0,
                'lang' => $courseData['lang'] ?? '',
                'forcetheme' => $courseData['forcetheme'] ?? '',
            ];
            
            // Call Moodle API to create course
            $response = $this->apiService->call('core_course_create_courses', [
                'courses' => [$course]
            ]);
            
            if (is_array($response) && !empty($response)) {
                return $response[0];
            }
            
            return null;
        } catch (Exception $e) {
            Log::error("Moodle Create Course Error: {$e->getMessage()}", [
                'courseData' => $courseData,
                'exception' => $e
            ]);
            
            throw new Exception("Error creating Moodle course: {$e->getMessage()}");
        }
    }

    /**
     * Update an existing course in Moodle
     *
     * @param int $courseId Moodle course ID
     * @param array $courseData Course data to update
     * @return bool
     */
    public function updateCourse($courseId, array $courseData)
    {
        try {
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Prepare course data for Moodle API
            $course = array_merge(['id' => $courseId], $courseData);
            
            // Call Moodle API to update course
            $this->apiService->call('core_course_update_courses', [
                'courses' => [$course]
            ]);
            
            return true;
        } catch (Exception $e) {
            Log::error("Moodle Update Course Error: {$e->getMessage()}", [
                'courseId' => $courseId,
                'courseData' => $courseData,
                'exception' => $e
            ]);
            
            throw new Exception("Error updating Moodle course: {$e->getMessage()}");
        }
    }

    /**
     * Delete a course in Moodle
     *
     * @param int $courseId Moodle course ID
     * @return bool
     */
    public function deleteCourse($courseId)
    {
        try {
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            // Call Moodle API to delete course
            $this->apiService->call('core_course_delete_courses', [
                'courseids' => [$courseId]
            ]);
            
            return true;
        } catch (Exception $e) {
            Log::error("Moodle Delete Course Error: {$e->getMessage()}", [
                'courseId' => $courseId,
                'exception' => $e
            ]);
            
            throw new Exception("Error deleting Moodle course: {$e->getMessage()}");
        }
    }

    /**
     * Get course categories
     *
     * @return array
     */
    public function getCategories()
    {
        try {
            // Call Moodle API to get categories
            $response = $this->apiService->call('core_course_get_categories');
            
            return $response;
        } catch (Exception $e) {
            Log::error("Moodle Get Categories Error: {$e->getMessage()}", [
                'exception' => $e
            ]);
            
            throw new Exception("Error getting Moodle categories: {$e->getMessage()}");
        }
    }

    /**
     * Create a new category in Moodle
     *
     * @param array $categoryData Category data
     * @return array|null
     */
    public function createCategory(array $categoryData)
    {
        try {
            // Required fields for Moodle category creation
            $requiredFields = ['name'];
            
            foreach ($requiredFields as $field) {
                if (!isset($categoryData[$field]) || empty($categoryData[$field])) {
                    throw new Exception("Missing required field: {$field}");
                }
            }
            
            // Prepare category data for Moodle API
            $category = [
                'name' => $categoryData['name'],
                'parent' => $categoryData['parent'] ?? 0,
                'idnumber' => $categoryData['idnumber'] ?? '',
                'description' => $categoryData['description'] ?? '',
                'descriptionformat' => $categoryData['descriptionformat'] ?? 1,
                'visible' => $categoryData['visible'] ?? 1,
            ];
            
            // Call Moodle API to create category
            $response = $this->apiService->call('core_course_create_categories', [
                'categories' => [$category]
            ]);
            
            if (is_array($response) && !empty($response)) {
                return $response[0];
            }
            
            return null;
        } catch (Exception $e) {
            Log::error("Moodle Create Category Error: {$e->getMessage()}", [
                'categoryData' => $categoryData,
                'exception' => $e
            ]);
            
            throw new Exception("Error creating Moodle category: {$e->getMessage()}");
        }
    }

    /**
     * Get course completion status for a user
     *
     * @param int $courseId Moodle course ID
     * @param int $userId Moodle user ID
     * @return array
     */
    public function getCourseCompletionStatus($courseId, $userId)
    {
        try {
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            // Call Moodle API to get course completion status
            $response = $this->apiService->call('core_completion_get_course_completion_status', [
                'courseid' => $courseId,
                'userid' => $userId
            ]);
            
            return $response;
        } catch (Exception $e) {
            Log::error("Moodle Get Course Completion Status Error: {$e->getMessage()}", [
                'courseId' => $courseId,
                'userId' => $userId,
                'exception' => $e
            ]);
            
            throw new Exception("Error getting Moodle course completion status: {$e->getMessage()}");
        }
    }

    /**
     * Get user grades for a course
     *
     * @param int $courseId Moodle course ID
     * @param int $userId Moodle user ID
     * @return array
     */
    public function getUserGrades($courseId, $userId)
    {
        try {
            if (!$courseId) {
                throw new Exception("Course ID is required");
            }
            
            if (!$userId) {
                throw new Exception("User ID is required");
            }
            
            // Call Moodle API to get user grades
            $response = $this->apiService->call('gradereport_user_get_grade_items', [
                'courseid' => $courseId,
                'userid' => $userId
            ]);
            
            return $response;
        } catch (Exception $e) {
            Log::error("Moodle Get User Grades Error: {$e->getMessage()}", [
                'courseId' => $courseId,
                'userId' => $userId,
                'exception' => $e
            ]);
            
            throw new Exception("Error getting Moodle user grades: {$e->getMessage()}");
        }
    }
}
