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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
            $table->string('dni')->nullable()->unique()->after('email');
            $table->unsignedBigInteger('coordinator_id')->nullable()->after('password');
            $table->string('code')->nullable()->after('coordinator_id');
            $table->string('phone')->nullable()->after('code');
            $table->boolean('status')->default(true)->after('phone');
            
            $table->foreign('coordinator_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['coordinator_id']);

            $table->dropColumn('dni');
            $table->dropColumn('coordinator_id');
            $table->dropColumn('code');
            $table->dropColumn('phone');
            $table->dropColumn('status');
        });
    }
};
