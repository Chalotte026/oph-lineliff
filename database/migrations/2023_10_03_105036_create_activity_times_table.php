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
        Schema::create('activity_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')
                ->constrained('activities');     
            $table->string('date');
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_times');
    }
};
