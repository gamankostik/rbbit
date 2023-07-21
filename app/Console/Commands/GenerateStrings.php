<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class
GenerateStrings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:strings {type} {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        if ($this->argument('type') == 'btc') {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $str = [];
            for ($i = 0; $i < $this->argument('number'); $i++) {
                $str[] = '1' . substr(str_shuffle($permitted_chars), 0, 33);
            }

            $fp = fopen($this->argument('type') . '_generated.csv', 'w');

            fputcsv($fp, $str);

            fclose($fp);

            print_r('Done');
        }
        if ($this->argument('type') == 'usdt') {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $str = [];
            for ($i = 0; $i < $this->argument('number'); $i++) {
                $str[] = 'TX' . substr(str_shuffle($permitted_chars), 0, 32);
            }

            $fp = fopen($this->argument('type') . '_generated.csv', 'w');

            fputcsv($fp, $str);

            fclose($fp);

            print_r('Done');
        }
        if ($this->argument('type') == 'eth') {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz0123456789abcdefghijklmnopqrstuvwxyz0123456789abcdefghijklmnopqrstuvwxyz';
            $str = [];
            for ($i = 0; $i < $this->argument('number'); $i++) {
                $str[] = '0x' . substr(str_shuffle($permitted_chars), 0, 40);
            }

            $fp = fopen($this->argument('type') . '_generated.csv', 'w');

            fputcsv($fp, $str);

            fclose($fp);

            print_r('Done');
        }
    }
}
