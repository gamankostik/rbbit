<?php

namespace App\Console\Commands;

use App\Model\Coin;
use Illuminate\Console\Command;

class MigrateCoinCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:coins';

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
        print_r("Start ... \n");
        foreach (Coin::TYPE as $type) {
            if (($handle = fopen(resource_path('data/' . $type . '.csv'), "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (!empty($data[1]) && !Coin::where(['hash' => $data[1]])->exists()) {
                        Coin::create(
                            [
                                'number' => $data[0],
                                'hash' => $data[1],
                                'amount' => $data[2],
                                'type' => $type,
                            ]
                        );
                    }
                }
                fclose($handle);
            }
        }

        print_r("End ... \n");

    }
}
