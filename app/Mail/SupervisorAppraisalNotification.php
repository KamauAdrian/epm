<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupervisorAppraisalNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public  $data;

    public function __construct($pmo_supervisor)
    {
        $this->data = $pmo_supervisor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Performance Appraisal Supervise Request';
        return $this->view('Emails.Appraisals.supervisor-notification')->subject($subject);
    }
}
