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
        Schema::table('transaksi_hutang', function (Blueprint $table) {
            $table->unsignedBigInteger('barangs__id');
            $table->foreign('barangs__id')->references('id')->on('barangs')->onDelete('cascade');
            $table->unsignedBigInteger('pangkalans__id');
            $table->foreign('pangkalans__id')->references('id')->on('pangkalans')->onDelete('cascade');
            // $table->unsignedBigInteger('hutang_id');
            // $table->foreign('hutang_id')->references('id')->on('hutang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_hutang', function (Blueprint $table) {
            $table->dropForeign(['barangs__id']);
            $table->dropColumn('barangs__id');
            $table->dropForeign(['pangkalans__id']);
            $table->dropColumn('pangkalans__id');
            // $table->dropForeign(['hutang_id']);
            // $table->dropColumn('hutang_id');
        });
    }
};
