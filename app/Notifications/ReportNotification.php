<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportNotification extends Notification
{
    use Queueable;

    private string $report;
    private string $user;

    public function __construct( string $report, string $user)
    {
        $this->report = $report;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    //Funcion para definir formato de correo electronico de notificacion de reporte de producto
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(':::: OFHOUSE ::::')
            ->line("Product:  $this->report has been reported")
            ->line("Reported by: $this->user")
            ->line("We will review the report and take the necessary actions")
            ->from('$notifiable->email', '$notifiable->name') 
            ->line('Thank you for using our application!');
    }
}
