<?php

namespace App\Events;

use App\Models\Payment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\RabbitMQ;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Log;


class SendPaymentSuccessEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
}
