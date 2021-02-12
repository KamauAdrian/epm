<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PmoAppraisalSupervisedNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($pmo_supervised)
    {
        $this->data = $pmo_supervised;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Performance Appraisal Supervised';
        return $this->view('Emails.Appraisals.pmo-appraisal-supervised')->subject($subject);
    }
}
