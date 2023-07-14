<?php

namespace App\Mail;

use App\Services\API;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CouponPDF extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $paper = array(0,0,215,460);

        $pdf = PDF::loadView('pdf.coupon', $this->data['payment'])->setPaper( $paper, 'portrait');

        return $this->markdown('emails.couponPDF', [
            'data' => $this->data,
        ])->subject($this->data["title"])
            ->attachData($pdf->output(), "Comprovante_de_pagamento.pdf");
    }
}
