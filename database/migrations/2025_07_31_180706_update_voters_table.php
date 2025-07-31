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
        Schema::table('voters', function (Blueprint $table) {
            $table->string('center')->nullable()->after('census_status');
            $table->boolean('guest')->default(false)->nullable()->change();
            $table->boolean('has_dni')->default(false)->nullable()->change();
            $table->boolean('mobilization')->default(true)->nullable()->change();
            $table->string('census_status')->default('enabled')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voters', function (Blueprint $table) {
            $table->dropColumn(['center']);
            $table->boolean('guest')->default(false)->nullable(false)->change();
            $table->boolean('has_dni')->default(false)->nullable(false)->change();
            $table->boolean('mobilization')->default(true)->nullable(false)->change();
            $table->string('census_status')->default('enabled')->nullable(false)->change();
        });
    }
};
