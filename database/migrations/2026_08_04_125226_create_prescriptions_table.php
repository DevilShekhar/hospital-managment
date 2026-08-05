<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::table('prescriptions', function (Blueprint $table) {

            $table->foreignId('patient_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('doctor_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('medical_record_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('medicine');

            $table->string('dosage')->nullable();

            $table->string('duration')->nullable();

            $table->text('instructions')->nullable();

            $table->boolean('status')->default(1);

        });
    }


    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {

            $table->dropForeign(['patient_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['medical_record_id']);

            $table->dropColumn([
                'patient_id',
                'doctor_id',
                'medical_record_id',
                'medicine',
                'dosage',
                'duration',
                'instructions',
                'status'
            ]);

        });
    }

   
};
