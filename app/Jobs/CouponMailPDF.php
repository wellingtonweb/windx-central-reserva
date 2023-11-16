<?php

namespace App\Jobs;



use App\Models\AppLog;
use App\Notifications\NotificationErrosApp;
use App\Services\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CouponPDF;
use App\Mail\Notification;
use Throwable;
use Illuminate\Notifications\Notifiable;


class CouponMailPDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Notifiable;

    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->data["email"])->send(new CouponPDF($this->data));
    }

    public function failed(Throwable $exception)
    {

//        AppLog::create([
//            'customer_id' => session('customer.id'),
//            'content' => 'Não foi possível enviar o comprovante do '.$this->data["payment_id"]. '.',
//            'operation' => 'checkout',
//            'status' => 'error'
//        ]);

//        Notification::route('mail', 'supwindx@gmail.com')
//            ->notify(new NotificationErrosApp($exception));
//        Notification::send(env('MAIL_ADMIN_APP'), new NotificationErrosApp($exception));
//        Mail::to(env('MAIL_ADMIN_APP'))->send(new Notification($exception));
    }
}
