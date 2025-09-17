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
        Schema::create('customer_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->boolean('is_auto_applied')->default(false); // Whether applied automatically or manually
            $table->text('notes')->nullable(); // Additional context
            $table->timestamp('expires_at')->nullable(); // Optional expiration for time-sensitive tags
            $table->timestamps();
            
            // Ensure unique customer-tag combinations
            $table->unique(['customer_id', 'tag_id']);
            
            // Indexes for better performance
            $table->index(['customer_id', 'is_auto_applied']);
            $table->index(['tag_id', 'is_auto_applied']);
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_tag');
    }
};