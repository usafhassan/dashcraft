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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('family_info')->nullable(); // Family details
            $table->json('occupation_info')->nullable(); // Occupation details
            $table->json('recreation_info')->nullable(); // Recreation/hobbies
            $table->json('motivation_info')->nullable(); // Motivations/goals
            $table->json('animals_info')->nullable(); // Pet preferences
            $table->json('favorite_teams')->nullable(); // Sports teams
            $table->string('color')->default('#3B82F6'); // UI color for badges
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};