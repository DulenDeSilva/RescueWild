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
        Schema::create('animal_record', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rescuer_id')->constrained('rescuer')->onDelete('cascade');
            $table->string('rescuer_name');
            $table->string('animal_species');
            $table->date('date');
            $table->string('medical_condition');
            $table->string('record_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_record');
    }
};
