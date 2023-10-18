<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClearExpiredRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:expired-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove registros expirados da tabela password_resets';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expirationTime = now()->subMinutes(15);

        DB::table('password_resets')
            ->where('created_at', '<', $expirationTime)
            ->delete();

        $this->info('Registros expirados removidos com sucesso.');
    }
}
