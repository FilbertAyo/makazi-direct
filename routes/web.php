<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LandlordController as AdminLandlordController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Property;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $properties = Property::query()
        ->with(['images' => fn ($q) => $q->orderBy('sort_order')->limit(1)])
        ->latest()
        ->take(6)
        ->get();

    return view('home', compact('properties'));
});

Route::get('/rentals', [\App\Http\Controllers\RentalController::class, 'index'])->name('rentals.index');
Route::get('/rentals/{property}', [\App\Http\Controllers\RentalController::class, 'show'])->name('rentals.show');

Route::match(['get', 'post'], '/contact', function (\Illuminate\Http\Request $request) {
    if ($request->isMethod('post')) {
        return back()->with('status', 'Thank you, your message has been received. We will contact you soon.');
    }

    return view('contact');
})->name('contact.show');

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tenant/dashboard', function () {
        return view('dashboard.tenant');
    })->middleware('role:tenant')->name('tenant.dashboard');

    Route::post('/rentals/{property}/start-chat', [\App\Http\Controllers\Client\Tenant\ChatController::class, 'store'])
        ->middleware('role:tenant')
        ->name('tenant.chats.start');

    Route::get('/landlord/dashboard', function () {
        return view('clients.dashboard.landlord');
    })->middleware(['role:landlord', 'approved'])->name('landlord.dashboard');

    Route::middleware(['role:landlord', 'approved'])->prefix('landlord')->name('landlord.')->group(function () {
        Route::resource('properties', \App\Http\Controllers\Client\Landlord\PropertyController::class);
    });

    Route::get('/admin/dashboard', AdminDashboardController::class)
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])
            ->name('users.index');
        Route::get('/landlords/pending', [\App\Http\Controllers\Admin\PendingLandlordController::class, 'index'])
            ->name('landlords.pending');
        Route::get('/landlords', [AdminLandlordController::class, 'index'])
            ->name('landlords.index');
        Route::get('/landlords/{user}', [AdminLandlordController::class, 'show'])
            ->name('landlords.show');
        Route::post('/landlords/{user}/approve', [\App\Http\Controllers\Admin\PendingLandlordController::class, 'approve'])
            ->name('landlords.approve');
        Route::post('/landlords/{user}/reject', [\App\Http\Controllers\Admin\PendingLandlordController::class, 'reject'])
            ->name('landlords.reject');
        Route::get('/documents/{document}', [\App\Http\Controllers\Admin\PendingLandlordController::class, 'showDocument'])
            ->name('documents.show');
        Route::get('/properties', [AdminPropertyController::class, 'index'])
            ->name('properties.index');
        Route::get('/properties/moderation', [AdminPropertyController::class, 'moderation'])
            ->name('properties.moderation');
        Route::get('/properties/{property}', [AdminPropertyController::class, 'show'])
            ->name('properties.show');
        Route::post('/properties/{property}/approve', [AdminPropertyController::class, 'approve'])
            ->name('properties.approve');
        Route::post('/properties/{property}/unverify', [AdminPropertyController::class, 'unverify'])
            ->name('properties.unverify');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/pending-approval', function () {
        return view('auth.register.pending');
    })->name('pending-approval');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
