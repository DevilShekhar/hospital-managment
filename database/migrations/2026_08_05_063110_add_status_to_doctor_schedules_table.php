<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_schedules', function (Blueprint $table) {
            // Status: 1 = Active, 0 = Inactive
            if (!Schema::hasColumn('doctor_schedules', 'status')) {
                $table->tinyInteger('status')->default(1)->after('is_available');
            }
        });
    }

    public function down(): void
    {
        Schema::table('doctor_schedules', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};