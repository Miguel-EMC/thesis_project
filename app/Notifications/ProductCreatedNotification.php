<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductCreatedNotification extends Notification
{
    use Queueable;

    private string $product_name;

    public function __construct(string $product_name)
    {
        $this->product_name = $product_name;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    //Funcion para definir formato de correo electronico de notificacion de producto creado    
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(':::: OFHOUSE ::::')
            ->line("Product:  $this->product_name has been created")
            ->line('Thank you for using our application!');
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}