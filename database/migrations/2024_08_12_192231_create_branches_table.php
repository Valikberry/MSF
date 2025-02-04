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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained(table: 'companies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained(table: 'cities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('image');
            $table->text('short_description')->nullable();
            $table->json('infolist')->nullable();
            $table->json('contacts')->nullable();
            $table->json('availability')->nullable();
            $table->text('description')->nullable();
            $table->string('owner_link')->nullable();
            $table->unique(['company_id', 'city_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
