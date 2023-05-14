<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $invoice;

    public function __construct($order, $invoice)
    {
        $this->invoice = $invoice;
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Received',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.received',
            with: [
                'order' => $this->order,
            ],
        );
    }

    public function attachments(): array
    {
        $filename = 'Shopi-'.$this->order->user->name ;
        $localPath = storage_path('app/public/' . $filename . '.pdf');
        return [
            Attachment::fromPath($localPath, 'Invoice-'.$filename.'#'.$this->order->id.'.pdf')
                ->as('Invoice-'.$filename.'#'.$this->order->id.'.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
