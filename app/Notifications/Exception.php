<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class Exception extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected $exception) {}

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject('Se ha producido un error grave en la aplicación')
            ->line('Un error grave ha ocurrido en la aplicación.')
            ->line('Error message: ' . $this->exception->getMessage())
            ->line('File: ' . $this->exception->getFile())
            ->line('Line: ' . $this->exception->getLine())
            ->line('Por favor, revisa el error y toma las medidas necesarias.');
    }
}
