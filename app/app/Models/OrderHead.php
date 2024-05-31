<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\OrderHeadObserver;

#[ObservedBy([OrderHeadObserver::class])]
class OrderHead extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['commission'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function getCommissionAttribute()
    {
        return $this->orders()->sum('commission');
    }
}
