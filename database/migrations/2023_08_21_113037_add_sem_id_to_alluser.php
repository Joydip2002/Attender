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
        Schema::table('alluser', function (Blueprint $table) {
            $table->unsignedBigInteger('sem_fk_id')->nullable();
            $table->foreign('sem_fk_id')->references('id')->on('semester')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alluser', function (Blueprint $table) {
            //
        });
    }
};
