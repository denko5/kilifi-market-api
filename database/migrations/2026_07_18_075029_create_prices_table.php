<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('market_id')
                ->constrained('markets')
                ->cascadeOnDelete();
            $table->foreignId('commodity_id')
                ->constrained('commodities')
                ->cascadeOnDelete();
            $table->decimal('price', 10, 2);
            $table->string('currency', 3)->default('KES');
            $table->date('price_date');
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->index('price_date');
            $table->index('market_id');
            $table->index('commodity_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};