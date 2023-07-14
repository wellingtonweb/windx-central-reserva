<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoicePDF extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $billet)
    {
        $this->data = $data;
        $this->billet = $billet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = PDF::loadView('pdf.invoice', $this->billet);

        return $this->markdown('emails.invoicePDF', [
            'data' => $this->data,
        ])->subject($this->data["title"])
            ->attachData($pdf->output(), "Fatura.pdf");
    }
}
