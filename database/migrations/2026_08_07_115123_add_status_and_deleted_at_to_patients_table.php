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
        Schema::table('patients', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('allergies');
            $table->timestamp('deleted_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['status', 'deleted_at']);
        });
    }
};
