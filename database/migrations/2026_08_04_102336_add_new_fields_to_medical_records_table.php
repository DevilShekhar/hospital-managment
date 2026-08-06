<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medical_records', function (Blueprint $table) {

            // 1. Safe Rename/Add treatment_status column
            if (Schema::hasColumn('medical_records', 'status')) {
                $table->renameColumn('status', 'treatment_status');
            } elseif (!Schema::hasColumn('medical_records', 'treatment_status')) {
                $table->string('treatment_status')->default('Active')->nullable();
            }

            // 2. Soft delete flag (Default 0 = Active, 1 = Soft Deleted)
            if (!Schema::hasColumn('medical_records', 'is_deleted')) {
                $table->boolean('is_deleted')->default(0); // 👈 Fixed default value to 0
            }

            // 3. Billing fields
            if (!Schema::hasColumn('medical_records', 'consultation_fee')) {
                $table->decimal('consultation_fee', 10, 2)->default(0);
                $table->decimal('medicine_charge', 10, 2)->default(0);
                $table->decimal('lab_charge', 10, 2)->default(0);
                $table->decimal('other_charge', 10, 2)->default(0);
                $table->decimal('discount', 10, 2)->default(0);
                $table->decimal('deposit_amount', 10, 2)->default(0);
                $table->decimal('total_amount', 10, 2)->default(0);
                $table->decimal('balance_amount', 10, 2)->default(0);

                $table->enum('payment_status', [
                    'Pending',
                    'Partially Paid',
                    'Paid'
                ])->default('Pending');

                $table->enum('payment_method', [
                    'Cash',
                    'Card',
                    'UPI',
                    'Insurance',
                    'Bank Transfer'
                ])->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('medical_records', function (Blueprint $table) {

            if (Schema::hasColumn('medical_records', 'treatment_status')) {
                $table->renameColumn('treatment_status', 'status');
            }

            $table->dropColumn([
                'is_deleted',
                'consultation_fee',
                'medicine_charge',
                'lab_charge',
                'other_charge',
                'discount',
                'deposit_amount',
                'total_amount',
                'balance_amount',
                'payment_status',
                'payment_method',
            ]);
        });
    }
};