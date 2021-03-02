<?php

namespace App\Jobs;

use App\Mail\SupervisorAppraisalNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PerformanceAppraisalSuperviseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $params;
    public function __construct($params_supervisor)
    {
        $this->params = $params_supervisor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dispatch jobs
        $email = $this->params["email"];
        $pmo_supervisor = $this->params["data_supervisor"];
        $pmo_pmo = $this->params["data_pmo"];
        Mail::to($email)->send(new SupervisorAppraisalNotification($pmo_supervisor,$pmo_pmo));
    }
}
