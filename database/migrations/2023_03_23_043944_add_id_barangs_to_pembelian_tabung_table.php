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
        Schema::table('pembelian_tabung', function (Blueprint $table) {
            $table->unsignedBigInteger('barangs_id');
            $table->foreign('barangs_id')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelian_tabung', function (Blueprint $table) {
            $table->dropForeign(['barangs_id']);
            $table->dropColumn('barangs_id');
        });
    }
};
