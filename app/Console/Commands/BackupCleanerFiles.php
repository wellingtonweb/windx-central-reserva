<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BackupCleanerFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:cleaner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for database backups old files clean.';

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
        $file_path = storage_path();
        $files = File::files("$file_path\app\backup");

        foreach ($files as $file) {
            $created_at = File::lastModified($file);
            if (time() - $created_at > 172800) {
                File::delete($file);
            }
        }

        return 0;
    }
}
