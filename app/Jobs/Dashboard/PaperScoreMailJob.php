<?php

namespace App\Jobs\Dashboard;

use App\Mail\Dashboard\UserScoreMail;
use App\Models\Paper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class PaperScoreMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Paper $paper)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->paper->scores as $score) {
            sleep(2);
            Mail::to($score->user->parent_email)->send(new UserScoreMail($score));
        }
    }
}