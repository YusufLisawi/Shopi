<?php

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brief_description');
            $table->text('description');
            $table->decimal('price');
            $table->decimal('old_price');
            $table->string('SKU');
            $table->enum('stock_status', ['instock', 'outstock']);
            $table->unsignedInteger('quantity')->default(10);
            $table->string('image');
            $table->text('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
