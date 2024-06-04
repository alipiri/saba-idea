<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];


    public function orderHeads(): HasMany
    {
        return $this->hasMany(OrderHead::class);
    }


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }


    public function commissions()
    {
        
    }
}
