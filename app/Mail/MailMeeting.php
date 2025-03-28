<?php

namespace App\Mail;

use App\Models\Company\CompanyDetails;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailMeeting extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $meeting;
    public $empresa;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($meeting)
    {
        $this->meeting = $meeting;
        $this->empresa = CompanyDetails::get()->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $email = $this->empresa->email;
        $mail = $this->from($email)
        ->subject('Acta de Reunion - '.$this->empresa->company_name)
        ->view('mails.mailMeeting');

        return $mail;
    }
}
