<?php

namespace App\Modules\Moodle\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Placeholder Model for Moodle User.
 * This model might not have a corresponding database table in Laravel 
 * if user data is primarily fetched from Moodle API.
 * It's used here mainly to satisfy Eloquent relationships.
 */
class MoodleUser extends Model
{
    // If you have a local table mirroring Moodle users, define it here:
    // protected $table = 'moodle_users'; 

    // Define the primary key if it's not 'id'
    // protected $primaryKey = 'moodle_id';

    // Disable timestamps if your table doesn't have them
    // public $timestamps = false;

    // Define fillable attributes if you store user data locally
    // protected $fillable = ['moodle_id', 'username', 'firstname', 'lastname', 'email', ...];

    /**
     * Get the certificates associated with the user.
     */
    public function certificates()
    {
        // Assumes the foreign key in MoodleCertificate is 'user_id' and references this model's primary key.
        // Adjust 'user_id' if the foreign key name is different.
        return $this->hasMany(MoodleCertificate::class, 'user_id');
    }
}

