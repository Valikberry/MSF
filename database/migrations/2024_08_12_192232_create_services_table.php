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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained(table: 'branches')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', \App\Enums\ServiceMeasureType::names())->default(\App\Enums\ServiceMeasureType::hour->name);
            $table->text('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
