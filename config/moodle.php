<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Moodle API Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration settings for connecting to the
    | Moodle API. You can specify different configurations for different
    | environments.
    |
    */

    // Moodle API connection settings
    'connection' => [
        'url' => env('MOODLE_API_URL', 'https://moodle.example.com'),
        'token' => env('MOODLE_API_TOKEN', ''),
        'protocol' => env('MOODLE_API_PROTOCOL', 'rest'),
        'format' => env('MOODLE_API_FORMAT', 'json'),
    ],

    // Default timeout for API requests in seconds
    'timeout' => env('MOODLE_API_TIMEOUT', 30),

    // Cache settings
    'cache' => [
        'enabled' => env('MOODLE_CACHE_ENABLED', true),
        'ttl' => env('MOODLE_CACHE_TTL', 3600), // Time to live in seconds
    ],

    // User synchronization settings
    'user_sync' => [
        'auto_create' => env('MOODLE_AUTO_CREATE_USERS', true),
        'auto_update' => env('MOODLE_AUTO_UPDATE_USERS', true),
        'default_role' => env('MOODLE_DEFAULT_USER_ROLE', 'student'),
    ],

    // Enrollment settings
    'enrollment' => [
        'auto_enroll' => env('MOODLE_AUTO_ENROLL', true),
        'enroll_method' => env('MOODLE_ENROLL_METHOD', 'manual'),
    ],

    // Certificate settings
    'certificates' => [
        'path' => env('MOODLE_CERTIFICATES_PATH', storage_path('app/certificates')),
        'template' => env('MOODLE_CERTIFICATE_TEMPLATE', 'default'),
        'signature_image' => env('MOODLE_SIGNATURE_IMAGE', ''),
    ],

    // Webhook settings
    'webhooks' => [
        'enabled' => env('MOODLE_WEBHOOKS_ENABLED', false),
        'secret' => env('MOODLE_WEBHOOKS_SECRET', ''),
    ],

    // Logging settings
    'logging' => [
        'enabled' => env('MOODLE_LOGGING_ENABLED', true),
        'level' => env('MOODLE_LOGGING_LEVEL', 'info'),
    ],
];
