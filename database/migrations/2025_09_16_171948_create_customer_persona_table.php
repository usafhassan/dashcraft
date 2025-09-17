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
        Schema::create('customer_persona', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('persona_id')->constrained()->onDelete('cascade');
            $table->integer('confidence_score')->default(0); // 0-100 confidence level
            $table->text('notes')->nullable(); // Additional notes about this relationship
            $table->timestamps();
            
            // Ensure unique customer-persona combinations
            $table->unique(['customer_id', 'persona_id']);
            
            // Indexes for better performance
            $table->index(['customer_id', 'confidence_score']);
            $table->index(['persona_id', 'confidence_score']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_persona');
    }
};