<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Tenant User',
                'email' => 'tenant@example.com',
                'password' => '123',
                'role' => 'tenant',
            ],
            [
                'name' => 'Landlord User',
                'email' => 'landlord@example.com',
                'password' => '123',
                'role' => 'landlord',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => '123',
                'role' => 'admin',
            ],
        ];

        foreach ($users as $data) {
            $password = $data['password'];
            $role = $data['role'];
            unset($data['password'], $data['role']);

            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'phone' => null,
                    'password' => $password,
                    'status' => User::STATUS_ACTIVE,
                ]
            );

            if (! $user->hasRole($role)) {
                $user->assignRole($role);
            }
        }
    }
}
