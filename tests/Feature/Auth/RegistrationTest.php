<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new tenant users can register via wizard', function () {
    Role::firstOrCreate(['name' => 'tenant']);

    $this->post('/register/role', ['role' => 'tenant']);

    $response = $this->post('/register/tenant', [
        'name' => 'Test Tenant',
        'email' => 'tenant@example.com',
        'phone' => '+255712345678',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));

    $user = User::where('email', 'tenant@example.com')->first();
    expect($user)->not->toBeNull()
        ->and($user->phone)->toBe('+255712345678')
        ->and($user->hasRole('tenant'))->toBeTrue()
        ->and($user->status)->toBe('active');
});
