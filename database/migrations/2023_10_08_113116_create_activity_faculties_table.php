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
        Schema::create('activity_faculties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')
                ->constrained('activities');
            $table->foreignId('faculty_id')
                ->constrained('faculties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_faculties');
    }
};
