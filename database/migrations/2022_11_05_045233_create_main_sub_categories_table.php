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
        Schema::create('main_sub_categories', function (Blueprint $table) {
            $table->id();                    
            $table->foreignId('main_category_id')
                  ->constrained('main_categories')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate(); 
            $table->foreignId('sub_category_id')
                  ->constrained('sub_categories')
                   ->cascadeOnDelete()
                   ->cascadeOnUpdate(); 
            $table->timestamps();
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
        Schema::dropIfExists('main_sub_categories');
    }
};
