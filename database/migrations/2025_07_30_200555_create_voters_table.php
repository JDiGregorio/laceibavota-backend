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
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('dni')->unique();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('sex')->nullable(); // 'M', 'F',
            $table->unsignedBigInteger('center_id')->nullable();
            $table->unsignedBigInteger('mobilizer_id')->nullable();
            $table->boolean('guest')->default(false);
            $table->boolean('has_dni')->default(false);
            $table->boolean('mobilization')->default(true);
            $table->string('mobilization_details')->nullable();
            $table->string('census_status')->default('enabled'); // 'enabled', 'disabled', 'pending'
            $table->timestamps();

            $table->foreign('center_id')->references('id')->on('centers')->onDelete('set null');
            $table->foreign('mobilizer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voters', function (Blueprint $table) {
            $table->dropForeign(['center_id']);
            $table->dropForeign(['mobilizer_id']);
        });

        Schema::dropIfExists('voters');
    }
};
