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
        Schema::table('doctor_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable()->after('id');
            $table->unsignedBigInteger('department_id')->nullable()->after('doctor_id');
            $table->date('schedule_date')->nullable()->after('department_id');
            $table->string('day_of_week')->nullable()->after('schedule_date');
            $table->time('start_time')->nullable()->after('day_of_week');
            $table->time('end_time')->nullable()->after('start_time');
            $table->integer('slot_duration')->default(15)->after('end_time');
            $table->integer('max_patients')->default(20)->after('slot_duration');
            $table->string('room_no')->nullable()->after('max_patients');
            $table->decimal('consultation_fee', 10, 2)->nullable()->after('room_no');
            $table->boolean('is_available')->default(1)->after('consultation_fee');
            $table->text('remarks')->nullable()->after('is_available');
            $table->softDeletes()->after('remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor_schedules', function (Blueprint $table) {
            $table->dropColumn([
                'doctor_id',
                'department_id',
                'schedule_date',
                'day_of_week',
                'start_time',
                'end_time',
                'slot_duration',
                'max_patients',
                'room_no',
                'consultation_fee',
                'is_available',
                'remarks',
            ]);
            $table->dropSoftDeletes();
        });
    }
};