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
        Schema::create('hangouts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('location_id')->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('address');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->description('0: inactive, 1: active')->default(1);
            $table->string('google_maps_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('longtitud')->nullable();
            $table->string('latitud')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hangouts');
    }
};
