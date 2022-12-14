<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisteredCostumerNotification extends Notification
{
    use Queueable;
    private string $user_name;
    private string $role_name;

    public function __construct(string $user_name, string $role_name)
    {
        $this->user_name = $user_name;
        $this->role_name = $role_name;
    }
    public function via(mixed $notifiable)
    {
        return ['mail'];
    }
    public function toMail(mixed $notifiable)
    {
        return (new MailMessage)
            ->greeting(':::: OFHOUSE ::::')
            ->greeting('Successfully Registered...!')
            ->line("Welcome to $this->user_name")
            ->line("Registration details: ")
            ->line("Your user role is: $this->role_name")
            ->line("Remember: do not share your password.")
            ->line('Thank you for using our application!');
    }
}
