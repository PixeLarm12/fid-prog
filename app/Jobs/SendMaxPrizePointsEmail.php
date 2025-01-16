<?php

namespace App\Jobs;

use App\Mail\MaxPrizePointsMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendMaxPrizePointsEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $users = User::where('fidelity_points', '>=', 20)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new MaxPrizePointsMail());
        }
    }
}
