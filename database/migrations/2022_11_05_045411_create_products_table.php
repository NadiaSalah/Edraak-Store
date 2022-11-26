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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->integer('quantity');
            $table->decimal('price',8,2);
            $table->integer('discount'); // 0:100 %
            $table->string('view')->default('normal'); // normal ,hot
            $table->boolean('return')->default(false); // return policy
            $table->timestamps();
            $table->foreignId('main_sub_category_id')
                  ->constrained('main_sub_categories')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
                  $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
