<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf; 

class OrderStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $mail = $this->view('emails.order_status')
                     ->subject('Update on your Order #' . str_pad($this->order->id, 6, '0', STR_PAD_LEFT));
 
        if ($this->order->status === 'completed') {
            
            $pdf = Pdf::loadView('pdfs.receipt', ['order' => $this->order]);
            
            $mail->attachData($pdf->output(), 'Order_Receipt_' . $this->order->id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }
}