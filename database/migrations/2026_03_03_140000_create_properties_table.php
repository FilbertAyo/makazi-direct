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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landlord_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->decimal('price', 12, 2);
            $table->unsignedTinyInteger('minimum_rent_months')->default(3);
            $table->string('property_type', 50); // single_room, master_bedroom, 1_bedroom, 2_bedroom, full_house
            $table->unsignedTinyInteger('bedrooms')->default(0);
            $table->unsignedTinyInteger('living_rooms')->default(0);
            $table->unsignedTinyInteger('bathrooms')->default(0);
            $table->unsignedTinyInteger('kitchens')->default(0);
            $table->boolean('has_fence')->default(false);
            $table->boolean('has_parking')->default(false);
            $table->text('dimensions')->nullable(); // room sizes / dimensions
            $table->text('description')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('distance_from_main_road')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
