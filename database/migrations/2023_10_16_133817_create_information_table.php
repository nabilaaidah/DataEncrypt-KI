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
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('NIK');
            $table->date('dob');
            $table->string('gender');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('geneticDisease');
            $table->string('allergies');
            $table->string('medications');
            $table->string('bloodPressure');
            $table->string('cholesterol');
            $table->string('medicalHistory');
            $table->string('ethicity');
            $table->string('sexualOrientation');
            $table->string('religion');
            $table->string('languages');
            $table->string('nationality');
            $table->string('politicalAffiliation');
            $table->string('biometricVideo');
            $table->string('biometricData');
            $table->string('eyeColor');
            $table->string('hairColor');
            $table->string('kkDocument');
            $table->string('photo1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
