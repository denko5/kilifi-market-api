<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commodities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('commodity_categories')
                ->cascadeOnDelete();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('unit');
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commodities');
    }
};