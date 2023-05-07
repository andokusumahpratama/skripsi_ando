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
        Schema::table('hutang', function (Blueprint $table) {
            $table->unsignedBigInteger('barangss_id');
            $table->foreign('barangss_id')->references('id')->on('barangs')->onDelete('cascade');
            $table->unsignedBigInteger('pangkalan_id');
            $table->foreign('pangkalan_id')->references('id')->on('pangkalans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hutang', function (Blueprint $table) {
            $table->dropForeign(['barangss_id']);
            $table->dropColumn('barangss_id');
            $table->dropForeign(['pangkalan_id']);
            $table->dropColumn('pangkalan_id');
        });
    }
};
