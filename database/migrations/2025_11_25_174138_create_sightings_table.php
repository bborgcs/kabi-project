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
        Schema::create('sightings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('species_id')->nullable()->constrained('species')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('image_id')->nullable()->constrained('images')->nullOnDelete();

            $table->string('gender')->nullable();
            $table->string('life_status')->nullable();
            $table->string('found_location')->nullable();
            $table->text('description')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sightings');
    }
};
