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
        Schema::table('pemenang_grand_prizes', function (Blueprint $table) {
            $table->string('nak')->nullable();
            $table->string('nik')->nullable();
            $table->string('departemen')->nullable();
            $table->string('bagian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemenang_grand_prizes', function (Blueprint $table) {
            //
        });
    }
};
