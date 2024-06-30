<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RecurringInvoiceNotification extends Notification
{
    use Queueable;

    protected $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable): MailMessage
    {
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toDatabase($notifiable): array
    {
        return [
            'transaction_id' => $this->invoice->id,
            'invoice_no' => $this->invoice->invoice_no,
            'invoice_status' => $this->invoice->status,
            'out_of_stock_product' => ! empty($this->invoice->out_of_stock_product) ? $this->invoice->out_of_stock_product : null,
            'subscription_no' => $this->invoice->subscription_no,
        ];
    }
}
