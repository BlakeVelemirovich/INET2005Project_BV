<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Category (dropdown), Title, Description, Price, Quantity, SKU, Picture
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table-> unsignedBigInteger('categoryId');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->string('sku');
            $table->string('picture');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
