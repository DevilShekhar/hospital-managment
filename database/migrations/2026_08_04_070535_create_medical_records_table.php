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
        Schema::create('medical_records', function (Blueprint $table) {

            $table->id();

            $table->string('record_no')->unique();

            $table->foreignId('patient_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('doctor_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->date('visit_date');

            $table->time('visit_time')->nullable();

            $table->text('symptoms');

            $table->text('diagnosis');

            $table->text('prescription');

            $table->text('doctor_notes')->nullable();

            $table->date('follow_up_date')->nullable();

            $table->enum('treatment_status', [
                'Registered',
                'Under Treatment',
                'Recovering',
                'Follow Up',
                'Discharged',
                'Cancelled'
            ])->default('Registered');

            // 1 = Not Deleted
            // 0 = Deleted
            $table->boolean('is_deleted')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};