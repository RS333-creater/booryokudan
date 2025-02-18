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
        Schema::create('planning', function (Blueprint $table) {
            $table->id('planning_id'); // 主キー
            // $table->unsignedBigInteger('facility_id'); // 外部キー
            $table->unsignedBigInteger('trip_id'); // 外部キー
            $table->text('sequence')->nullable();
            $table->timestamps();

            // $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->foreign('trip_id')->references('trip_id')->on('trip')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planning');
    }
};
