<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\ProductObserver;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class);
    }
}
