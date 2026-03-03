<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    { 
        $pdf = Pdf::loadView('pdfs.receipt', ['order' => $this->order]);

        return $this->view('emails.receipt')
                    ->subject('Your Order Receipt - The Saturation Point')
                    ->attachData($pdf->output(), 'Order_Receipt_' . $this->order->id . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}