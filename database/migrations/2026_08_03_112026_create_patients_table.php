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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string('patient_id')->unique();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();

            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();

            $table->string('first_name');
            $table->string('last_name');

            $table->enum('gender', ['Male', 'Female', 'Other']);

            $table->date('date_of_birth');

            $table->string('phone')->unique();

            $table->string('email')->nullable()->unique();

            $table->string('blood_group')->nullable();

            $table->string('marital_status')->nullable();

            $table->string('occupation')->nullable();

            $table->text('address');

            $table->string('city')->nullable();

            $table->string('state')->nullable();

            $table->string('country')->nullable();

            $table->string('pin_code')->nullable();

            $table->string('emergency_contact_name');

            $table->string('emergency_contact_phone');

            $table->string('relation')->nullable();

            $table->text('medical_history')->nullable();

            $table->text('allergies')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
