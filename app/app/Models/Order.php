<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orderHead()
    {
        return $this->belongsTo(OrderHead::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
