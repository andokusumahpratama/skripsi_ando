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
        Schema::table('transaksis', function (Blueprint $table) {
            $table->unsignedBigInteger('jual_tabung_id');
            $table->foreign('jual_tabung_id')->references('id')->on('jual_tabung')->onDelete('cascade');
            $table->unsignedBigInteger('pangkalan_id');
            $table->foreign('pangkalan_id')->references('id')->on('pangkalans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['jual_tabung_id']);
            $table->dropColumn('jual_tabung_id');
            $table->dropForeign(['pangkalan_id']);
            $table->dropColumn('pangkalan_id');
        });
    }
};
