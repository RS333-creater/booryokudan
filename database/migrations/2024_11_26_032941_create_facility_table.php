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
        Schema::dropIfExists('facility');
        Schema::create('facility', function (Blueprint $table) {
            $table->id('facility_id'); // 主キー
            $table->string('name');
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('openinghours')->nullable();
            $table->unsignedBigInteger('planning_id')->nullable();
            $table->timestamps();

            $table->foreign('planning_id')->references('planning_id')->on('planning')->onDelete('set null')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility');
    }
};
