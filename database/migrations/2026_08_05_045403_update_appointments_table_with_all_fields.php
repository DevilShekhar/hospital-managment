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
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('appointment_no')->nullable()->after('id');
            $table->unsignedBigInteger('patient_id')->nullable()->after('appointment_no');
            $table->string('patient_name')->nullable()->after('patient_id');
            $table->string('mobile_number')->nullable()->after('patient_name');
            $table->unsignedBigInteger('department_id')->nullable()->after('mobile_number');
            $table->unsignedBigInteger('specialist_id')->nullable()->after('department_id');
            $table->unsignedBigInteger('doctor_id')->nullable()->after('specialist_id');
            $table->date('appointment_date')->nullable()->after('doctor_id');
            $table->time('appointment_time')->nullable()->after('appointment_date');
            $table->string('visit_type')->nullable()->after('appointment_time');
            $table->string('priority')->default('Normal')->after('visit_type');
            $table->text('reason')->nullable()->after('priority');
            $table->text('notes')->nullable()->after('reason');
            $table->string('status')->default('Scheduled')->after('notes');
            $table->softDeletes()->after('status'); // 👈 Soft Delete Support (deleted_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'appointment_no',
                'patient_id',
                'patient_name',
                'mobile_number',
                'department_id',
                'specialist_id',
                'doctor_id',
                'appointment_date',
                'appointment_time',
                'visit_type',
                'priority',
                'reason',
                'notes',
                'status',
            ]);
            $table->dropSoftDeletes();
        });
    }
};