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
        Schema::table('appointments', function (Blueprint $table) {

            if (!Schema::hasColumn('appointments', 'is_active')) {
                $table->boolean('is_active')
                    ->default(1)
                    ->after('status');
            }

            if (!Schema::hasColumn('appointments', 'deleted_at')) {
                $table->timestamp('deleted_at')
                    ->nullable()
                    ->after('is_active');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {

            if (Schema::hasColumn('appointments', 'is_active')) {
                $table->dropColumn('is_active');
            }

            if (Schema::hasColumn('appointments', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }

        });
    }
};
