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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->text('password');
            $table->string('phone_number');
            $table->double('balance')->default(0.0);
            $table->text('address');
            $table->string('consultation');
            $table->text('experience');
            $table->text('exp_description');
            $table->integer('stars')->nullable();
            $table->double('consultation_price')->default(0.0);
            $table->string('image_path')->nullable();
            $table->string('api_token')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experts');
    }
};
