<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('senha.redefinir', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false));

        return (new MailMessage)
            ->subject('Redefinição de senha - Encontre Arte')
            ->greeting('Olá, ' . $notifiable->name)
            ->line('Recebemos uma solicitação para redefinir sua senha.')
            ->action('Redefinir senha', $url)
            ->line('Se você não fez essa solicitação, ignore este e-mail.')
            ->salutation('Atenciosamente, Encontre Arte');
    }
}
