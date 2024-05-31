<?php

use App\Models\OrderHead;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OrderHead::class);
            $table->foreignIdFor(Product::class);
            $table->integer('amount');
            $table->bigInteger('product_price');
            $table->bigInteger('total_price');
            $table->bigInteger('commission');
            $table->timestamps();
            $table->index(['order_head_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
