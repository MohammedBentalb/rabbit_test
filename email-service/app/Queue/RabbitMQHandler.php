<?php

namespace App\Queue;

use App\Jobs\SendForgotPasswordEmail;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Log;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob;

class RabbitMQHandler {

    public function handle(RabbitMQJob $job, array $data){
        $eventType = $data['event_type'] ?? null;
        Log::info("RabbitMq Message Recieved: " . ($eventType ?? 'Unknown Event'));

        match($eventType){
            'auth.user.registered' => SendWelcomeEmail::dispatch($data),
            'auth.user.forgot_password' => SendForgotPasswordEmail::dispatch($data),
            default => Log::warning("Recieved Event with no matching handler: " . json_encode($data))
        };
        $job->delete();
    }

}