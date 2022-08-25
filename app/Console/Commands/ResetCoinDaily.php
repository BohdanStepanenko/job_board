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
    protected $description = 'Add users daily coins count';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $coins_to_update = Coin::where('count', '<', config('pricing.coins.max_count'))->pluck('count');

        foreach ($coins_to_update as $count)
        {
            $add_value = $count < 4 ? config('pricing.coins.daily_add') : 1;

            Coin::where('count', $count)->update(['count' => $count + $add_value]);
        }

        $this->info('Coins count has been successfully added');
    }
}
