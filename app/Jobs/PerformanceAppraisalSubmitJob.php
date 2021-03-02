<?php

namespace App\Jobs;

use App\Mail\PmoAppraisalNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PerformanceAppraisalSubmitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $params;
    public function __construct($params_pmo)
    {
        $this->params = $params_pmo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dispatch the jobs to send appraisal notification emails
        $email = $this->params['email'];
        $pmo = $this->params['data'];
        Mail::to($email)->send(new PmoAppraisalNotification($pmo));
    }
}
