<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->foreignId('product_size_id')
                ->constrained('product_sizes')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->decimal('price',8,2);
            $table->integer('quantity');
            $table->decimal('total_price',8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};