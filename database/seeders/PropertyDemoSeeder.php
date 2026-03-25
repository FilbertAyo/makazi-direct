<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyContact;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PropertyDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $landlord = User::firstOrCreate(
            ['email' => 'demo-landlord@makazidirect.com'],
            [
                'name' => 'Demo Landlord',
                'phone' => '+255700111222',
                'password' => Hash::make('password'),
                'status' => User::STATUS_ACTIVE,
            ]
        );
        if (! $landlord->hasRole('landlord')) {
            $landlord->assignRole('landlord');
        }

        $tenant = User::firstOrCreate(
            ['email' => 'demo-tenant@makazidirect.com'],
            [
                'name' => 'Demo Tenant',
                'phone' => '+255700333444',
                'password' => Hash::make('password'),
                'status' => User::STATUS_ACTIVE,
            ]
        );
        if (! $tenant->hasRole('tenant')) {
            $tenant->assignRole('tenant');
        }

        $property = Property::updateOrCreate(
            [
                'landlord_id' => $landlord->id,
                'title' => 'Demo Apartment - Mikocheni',
            ],
            [
                'price' => 450000,
                'minimum_rent_months' => 3,
                'property_type' => Property::TYPE_2_BEDROOM,
                'bedrooms' => 2,
                'living_rooms' => 1,
                'bathrooms' => 2,
                'kitchens' => 1,
                'has_fence' => true,
                'has_parking' => true,
                'dimensions' => 'Living room 5m x 4m, bedrooms 4m x 3m',
                'description' => 'Clean and secure apartment near transport and shops.',
                'house_rules' => "No pets.\nNo loud noise after 10PM.\nRent is payable before the 5th of each month.",
                'distance_from_main_road' => '250m',
                'is_verified' => true,
            ]
        );

        $property->contacts()->delete();
        $property->contacts()->createMany([
            [
                'label' => 'Primary',
                'type' => PropertyContact::TYPE_PHONE,
                'value' => '+255712345678',
                'sort_order' => 0,
            ],
            [
                'label' => 'WhatsApp',
                'type' => PropertyContact::TYPE_WHATSAPP,
                'value' => '+255734567890',
                'sort_order' => 1,
            ],
        ]);
    }
}
