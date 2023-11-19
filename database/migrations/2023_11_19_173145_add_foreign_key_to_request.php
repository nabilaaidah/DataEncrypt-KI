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
        Schema::table('requesting', function (Blueprint $table) {
            $table->integer('information_id');
            $table->foreign('information_id')->references('id')->on('information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requesting', function (Blueprint $table) {
            //
        });
    }
};
