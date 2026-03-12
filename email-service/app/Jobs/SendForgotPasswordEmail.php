<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendForgotPasswordEmail implements ShouldQueue
{
    use Queueable;

    public function __construct(public array $data) {}

    public function handle(): void {
        Log::info("Sending forgot password email to: " . ($this->data['email'] ?? 'unknown'));
    }
}
