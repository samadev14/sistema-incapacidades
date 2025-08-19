<?php
/* Archivo que contiene la generación de correo electrónicos. Se hace uso de Mailtrap para simular el recibimiento de los correos electrónicos enviados desde el módulo Notificaciones. */

namespace App\Mail;

use App\Models\Notifity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifityMailable extends Mailable
{
    use Queueable, SerializesModels;

    public Notifity $notifity;

    /**
     * Create a new message instance.
     */
    public function __construct(Notifity $notifity)
    {
        $this->notifity = $notifity;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificación Sobre el Estado de Incapacidad',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.notifity',
            with: [
                'fullName' => $this->notifity->employee->full_name,
                'message' => $this->notifity->message,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
