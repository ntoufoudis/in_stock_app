<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';

    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function track(): void
    {
        $status = $this->retailer
            ->client()
            ->checkAvailability($this);

        $this->update([
            'in_stock' => $status->available,
            'price' => $status->price,
        ]);

        $this->recordHistory();
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }

    /**
     * @return void
     */
    protected function recordHistory(): void
    {
        $this->history()->create([
            'price' => $this->price,
            'in_stock' => $this->in_stock,
            'product_id' => $this->product_id,
        ]);
    }
}
