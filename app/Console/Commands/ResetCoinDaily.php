<?php

namespace App\Console\Commands;

use App\Models\Coin;
use Illuminate\Console\Command;

class ResetCoinDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coin:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset users coins count to default value';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Coin::query()->update(['count' => 5]);

        $this->info('Coins count has been successfully reset to default value');
    }
}
