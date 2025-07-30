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
        Schema::create('center_mobilizer', function (Blueprint $table) {
            $table->unsignedBigInteger('mobilizer_id');
            $table->unsignedBigInteger('center_id');

            $table->primary(['mobilizer_id', 'center_id']);

            $table->foreign('mobilizer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('center_mobilizer', function (Blueprint $table) {
            $table->dropForeign(['mobilizer_id']);
            $table->dropForeign(['center_id']);
        });

        Schema::dropIfExists('center_mobilizer');
    }
};
