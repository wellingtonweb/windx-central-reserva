<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class SendPDFCoupon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:pdf-coupon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command send emails in queues';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Send email test');
    }
}
