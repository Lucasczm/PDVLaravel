<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDataCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backaupdata:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria backup da base de dados';

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
     * @return mixed
     */
    public function handle()
    {
        $ds = DIRECTORY_SEPARATOR;
        $path = database_path() . $ds . 'backups' . $ds . date('Y') . $ds . date('m') . $ds;
        $file = date('Y-m-d-H-i-s') . '_mysqldump.sql';
                
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        exec("mysqldump --user=".getenv('DB_USERNAME')." --password=".getenv('DB_PASSWORD')." --host=".getenv('DB_HOST'). " " . getenv('DB_DATABASE')." --result-file={$path}{$file} ", $output);
        $this->info('Backup executado');
    }
}
