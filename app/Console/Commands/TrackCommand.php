<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class TrackCommand extends Command
{
    protected $signature = 'track';

    protected $description = 'Track all product stock.';

    public function handle()
    {
        Product::all()->each->track();
    }
}
