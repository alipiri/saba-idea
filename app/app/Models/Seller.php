<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];


    public function orderHeads()
    {
        return $this->hasMany(OrderHead::class);
    }

    public function commissions()
    {
        return $this->orderHeads()->select(['id', 'commission', 'product_id']);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
