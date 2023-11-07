<?php

namespace App\Models;

use App\Events\NowInStockEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function track($callback = null): void
    {
        $status = $this->retailer
            ->client()
            ->checkAvailability($this);

        if (! $this->in_stock && $status->available) {
            event(new NowInStockEvent($this));
        }

        $this->update([
            'in_stock' => $status->available,
            'price' => $status->price,
        ]);

        $callback && $callback($this);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
