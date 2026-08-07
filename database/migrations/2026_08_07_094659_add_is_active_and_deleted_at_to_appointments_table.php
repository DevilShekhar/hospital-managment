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

            $table->boolean('is_active')
                ->default(1)
                ->after('status');

            $table->timestamp('deleted_at')
                ->nullable()
                ->after('is_active');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {

            $table->dropColumn([
                'is_active',
                'deleted_at'
            ]);

        });
    }
};
