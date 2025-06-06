<?php

namespace App\Modules\Moodle\Models;

 use App\Modules\Moodle\Services\MoodleCourseService;
use App\Modules\Moodle\Services\MoodleUserService;
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


    public function getMoodleUser(): ?array
    {
        $service = app(MoodleUserService::class);
        return $service->getUser($this->user_id);
    }

    public function getMoodleCourse(): ?array
    {
        $service = app(MoodleCourseService::class);
        return $service->getCourse($this->course_id);
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
