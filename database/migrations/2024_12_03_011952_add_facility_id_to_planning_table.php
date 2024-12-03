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
        Schema::table('planning', function (Blueprint $table) {
            if (!Schema::hasColumn('planning', 'facility_id')) {
                $table->unsignedBigInteger('facility_id')->nullable(); // 外部キーとして使用
                $table->foreign('facility_id')
                      ->references('facility_id')
                      ->on('facility')
                      ->onDelete('set null');
            }
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planning', function (Blueprint $table) {
            $table->dropForeign(['facility_id']); // 外部キー制約を削除
            $table->dropColumn('facility_id'); // カラムを削除
        });
    }
};
