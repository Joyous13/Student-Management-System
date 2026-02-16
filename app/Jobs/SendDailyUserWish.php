<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendDailyUserWish implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $wish;

    public function __construct(string $wish)
    {
        $this->wish = $wish;
    }

    public function handle()
    {
        // Get all users
        $users = User::all();

        foreach ($users as $user) {
            // Example: Log message (replace with actual SMS or email)
            \Log::info("Sending '{$this->wish}' to: {$user->name} ({$user->phone})");

            // Send SMS Example
            // SmsHelper::send($user->phone, $this->wish);

            // Send Email Example
            // Mail::to($user->email)->send(new WishMail($this->wish));
        }
    }
}
