<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weather_cache', function (Blueprint $table) {
            $table->id();
            $table->foreignId('market_id')
                ->constrained('markets')
                ->cascadeOnDelete();
            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('rainfall', 6, 2)->nullable();
            $table->decimal('wind_speed', 5, 2)->nullable();
            $table->decimal('humidity', 5, 2)->nullable();
            $table->string('weather_code')->nullable();
            $table->timestamp('retrieved_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weather_cache');
    }
};