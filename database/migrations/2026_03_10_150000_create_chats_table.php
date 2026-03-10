<?php

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Property::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'landlord_id')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'tenant_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['property_id', 'landlord_id', 'tenant_id'], 'chats_property_landlord_tenant_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};

