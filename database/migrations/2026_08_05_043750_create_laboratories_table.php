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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();

            $table->string('lab_code')->unique();
            $table->string('test_name');
            $table->foreignId('department_id')
                    ->constrained('departments')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            $table->string('category');
            $table->string('sample_type');
            $table->string('container_type');

            $table->decimal('price', 10, 2);

            $table->integer('turnaround_time');

            $table->boolean('fasting_required')->default(false);

            $table->boolean('home_collection')->default(false);

            $table->text('description')->nullable();

            $table->timestamps();
            $table->boolean('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};
