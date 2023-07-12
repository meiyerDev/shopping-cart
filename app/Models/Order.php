<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    const STATUS_CREATED = 'CREATED';
    const STATUS_PAYED = 'PAYED';
    const STATUS_REJECTED = 'REJECTED';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'code',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        parent::creating(function ($model) {
            $model->code ??= Str::uuid()->toString();
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps();
    }

    public function placetoPays()
    {
        return $this->hasMany(PlacetoPay::class);
    }

    # Assesors
    public function getAmountTotalAttribute()
    {
        return $this->products->sum('price');
    }

    # Methods
    public function latestPlacetoPay()
    {
        return $this->placetoPays->last();
    }

    public function findPlacetoPlayByReferenceId(string $referenceId)
    {
        return $this->placetoPays->firstWhere('reference', $referenceId);
    }
}
