<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('employee_id')->nullable()->unique()->after('last_name');
            $table->string('mobile')->nullable()->after('email');
            $table->string('gender')->nullable()->after('mobile');
            $table->date('dob')->nullable()->after('gender');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null')->after('dob');
            $table->string('photo')->nullable()->after('password');
            $table->tinyInteger('status')->default(1)->after('photo');
            $table->text('address')->nullable()->after('status');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('pincode')->nullable()->after('state');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn([
                'first_name', 'last_name', 'employee_id', 'mobile', 'gender',
                'dob', 'department_id', 'photo', 'status', 'address', 'city', 'state', 'pincode'
            ]);
        });
    }
};