<?php

namespace App\Jobs;

use App\Events\ChangeStatusPodcast;
use App\Models\Podcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessPodcast implements ShouldQueue
{
    use Queueable;


    /**
     * Create a new job instance.
     */
    public function __construct(
        private Podcast $podcast
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        sleep(3);

        $this->podcast->update([
            'status' => !$this->podcast->status
        ]);

        $this->podcast->fresh();

        ChangeStatusPodcast::dispatch($this->podcast);

    }
}
