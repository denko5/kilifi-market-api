<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_id')
                ->constrained('prices')
                ->cascadeOnDelete();
            $table->decimal('old_price', 10, 2);
            $table->decimal('new_price', 10, 2);
            $table->foreignId('changed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('changed_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_histories');
    }
};