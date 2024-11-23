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
        Schema::create('plant_monitorings', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('plant_id');
            $table->integer('temperature');
            $table->integer('humidity');
            $table->enum('status', ['Lembab', 'Terawat', 'Kering']);
            $table->date('date');
            $table->timestamps();

            $table->index('plant_id')->references('id')->on('plants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_monitorings');
    }
};
