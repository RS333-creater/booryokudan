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
        Schema::create('trip', function (Blueprint $table) {
            $table->id('trip_id'); // 主キー
            $table->string('start_point');
            $table->string('end_point');
            $table->string('state')->nullable();
            $table->unsignedBigInteger('user_id'); // 外部キー
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip');
    }
};
