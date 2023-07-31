<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:numbers {count} {number1} {number2} {decimal}';

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
        $numbers = [];
        for ($i = 0; $i < $this->argument('count'); $i++) {
            $numbers[] = $this->generateRandomFloat($this->argument('number1'), $this->argument('number2'), $this->argument('decimal'));
        }

        $fp = fopen('numbers_generated.csv', 'w');

        fputcsv($fp, $numbers);

        fclose($fp);

        print_r('Done');
    }

    function generateRandomFloat($min, $max, $decimalPlaces) {
        $randomInt = mt_rand($min * pow(10, $decimalPlaces), $max * pow(10, $decimalPlaces));
        return $randomInt / pow(10, $decimalPlaces);
    }

}
