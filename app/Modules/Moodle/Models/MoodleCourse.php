<?php

namespace App\Modules\Moodle\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Placeholder Model for Moodle Course.
 * This model might not have a corresponding database table in Laravel 
 * if course data is primarily fetched from Moodle API.
 * It's used here mainly to satisfy Eloquent relationships.
 */
class MoodleCourse extends Model
{
    // If you have a local table mirroring Moodle courses, define it here:
    // protected $table = 'moodle_courses'; 

    // Define the primary key if it's not 'id'
    // protected $primaryKey = 'moodle_id';

    // Disable timestamps if your table doesn't have them
    // public $timestamps = false;

    // Define fillable attributes if you store course data locally
    // protected $fillable = ['moodle_id', 'shortname', 'fullname', 'category_id', ...];

    /**
     * Get the certificates associated with the course.
     */
    public function certificates()
    {
        // Assumes the foreign key in MoodleCertificate is 'course_id' and references this model's primary key.
        // Adjust 'course_id' if the foreign key name is different.
        return $this->hasMany(MoodleCertificate::class, 'course_id');
    }
}

