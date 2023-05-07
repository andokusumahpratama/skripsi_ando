<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropForeign(['jabatan_id']);
            $table->dropColumn('jabatan_id');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
