<?php

namespace App\Modules\Moodle\Models;

use Illuminate\Database\Eloquent\Model;

class MoodleCertificate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'moodle_certificates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'certificate_id',
        'filename',
        'issued_at',
        'verified',
        'metadata'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'issued_at' => 'datetime',
        'verified' => 'boolean',
        'metadata' => 'array'
    ];

    /**
     * Get the user that owns the certificate.
     */
    public function user()
    {
        return $this->belongsTo(MoodleUser::class, 'user_id');
    }

    /**
     * Get the course that the certificate is for.
     */
    public function course()
    {
        return $this->belongsTo(MoodleCourse::class, 'course_id');
    }

    /**
     * Get the full path to the certificate file.
     *
     * @return string
     */
    public function getFilePath()
    {
        return config('moodle.certificates.path') . '/' . $this->filename;
    }

    /**
     * Get the verification URL for the certificate.
     *
     * @return string
     */
    public function getVerificationUrl()
    {
        return url('/verify-certificate/' . $this->certificate_id);
    }
}
