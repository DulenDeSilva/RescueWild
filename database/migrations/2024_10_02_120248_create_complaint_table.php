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
        Schema::create('complaint', function(Blueprint $table){
            $table->id()->primary();
            $table->foreignId('client_id')->constrained('client')->onDelete('cascade');
            $table->string('complaint_location');
            $table->string('complaint_description');
            $table->string('complaint_status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint');
    }
};
