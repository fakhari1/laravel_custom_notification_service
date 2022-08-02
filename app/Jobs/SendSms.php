<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\Notification\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $text;

    public function __construct(User $user, string $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function handle(Notification $notification)
    {
        $notification->sendSms($this->user, $this->text);
    }
}
