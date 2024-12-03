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
        Schema::create('corporation', function (Blueprint $table) {
            $table->id('corporation_id'); // 主キー
            $table->string('address');
            $table->string('tel')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('planning_id')->nullable();
            $table->unsignedBigInteger('facility_id')->nullable();
            $table->timestamps();

            $table->foreign('planning_id')->references('planning_id')->on('planning')->onDelete('set null');
            $table->foreign('facility_id')->references('facility_id')->on('facility')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('corporation');
    }
};
