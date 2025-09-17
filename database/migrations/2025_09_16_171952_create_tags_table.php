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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['opportunity', 'activation', 'behavioral', 'demographic'])->default('opportunity');
            $table->string('color')->default('#10B981'); // Default green for opportunities
            $table->json('activation_rules')->nullable(); // Rules for automatic tagging
            $table->integer('priority')->default(0); // Higher numbers = higher priority
            $table->boolean('is_active')->default(true);
            $table->boolean('auto_apply')->default(false); // Whether to auto-apply based on rules
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for better performance
            $table->index(['type', 'is_active']);
            $table->index(['priority', 'is_active']);
            $table->index('auto_apply');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};