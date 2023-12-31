<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('retailer_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('price');
            $table->string('sku')->nullable();
            $table->string('url');
            $table->boolean('in_stock');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock');
    }
};
