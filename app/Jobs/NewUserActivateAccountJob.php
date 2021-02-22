<?php

namespace App\Jobs;

use App\Mail\CreatePassword;
use App\Mail\ProjectCollaborationInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewUserActivateAccountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //send email
        $email = $this->params['email'];
        $data = $this->params['data'];
        Mail::to($email)->send(new CreatePassword($data));
//        Mail::to($email)->send(new ProjectCollaborationInvite($collaborator));
    }
}
