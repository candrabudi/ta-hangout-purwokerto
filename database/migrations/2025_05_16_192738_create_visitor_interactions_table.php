<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitor_interactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('visitor_id');
            $table->foreignId('hangout_id')->constrained()->onDelete('cascade');
            $table->enum('interaction_type', ['view', 'like', 'bookmark', 'share', 'rating']);
            $table->tinyInteger('rating_value')->nullable();
            $table->timestamps();

            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_interactions');
    }
};
