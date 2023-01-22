<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(':::: OFHOUSE ::::')
            ->subject(Lang::get('Notificación de restablecimiento de contraseña'))
            ->line(Lang::get('Está recibiendo este correo electrónico porque hemos recibido una solicitud de restablecimiento de contraseña para su cuenta.'))
            ->action(Lang::get('Restablecer contraseña'), 'http://localhost:3000/login/resetpssw/confirmation/'.$this->token)
            ->line(Lang::get('Este enlace de restablecimiento de contraseña caducará en :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('Si no ha solicitado el restablecimiento de la contraseña, no es necesario realizar ninguna acción.'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
