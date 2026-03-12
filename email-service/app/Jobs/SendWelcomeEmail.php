<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $userData) {}

    /**2
     * Execute the job.
     */
    public function handle(): void {
        Mail::to($this->userData['email'])->send(new WelcomeEmail($this->userData));
    }
}
