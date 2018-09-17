<?php

namespace App\Jobs;

use App\Http\Helpers\SendDataHelper;
use App\USSDSession;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEstimatesDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $session;

    /**
     * Create a new job instance.
     *
     * @param USSDSession $session
     */
    public function __construct(USSDSession $session)
    {
        $this->session = $session;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $helper = new SendDataHelper($this->session);
        $helper->handle();
    }


}
