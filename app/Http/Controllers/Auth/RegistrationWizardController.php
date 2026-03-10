<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LandlordDocument;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegistrationWizardController extends Controller
{
    private const SESSION_KEY_ROLE = 'registration.role';

    private const SESSION_KEY_LANDLORD = 'registration.landlord';

    /**
     * Tanzania phone: +255 followed by 9 digits.
     */
    public const PHONE_REGEX = '/^\+255[0-9]{9}$/';

    public function showRoleSelection(): View
    {
        return view('auth.register.role');
    }

    public function storeRole(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'in:tenant,landlord'],
        ]);

        session([self::SESSION_KEY_ROLE => $request->role]);

        return $request->role === 'tenant'
            ? redirect()->route('register.tenant')
            : redirect()->route('register.landlord.details');
    }

    public function showTenantForm(Request $request): View|RedirectResponse
    {
        if (session(self::SESSION_KEY_ROLE) !== 'tenant') {
            return redirect()->route('register');
        }

        return view('auth.register.tenant');
    }

    public function storeTenant(Request $request): RedirectResponse
    {
        if (session(self::SESSION_KEY_ROLE) !== 'tenant') {
            return redirect()->route('register');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'regex:'.self::PHONE_REGEX, 'unique:users,phone'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'status' => User::STATUS_ACTIVE,
        ]);

        $user->assignRole('tenant');

        event(new Registered($user));

        $this->clearRegistrationSession();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function showLandlordDetails(Request $request): View|RedirectResponse
    {
        if (session(self::SESSION_KEY_ROLE) !== 'landlord') {
            return redirect()->route('register');
        }

        return view('auth.register.landlord-details');
    }

    public function storeLandlordDetails(Request $request): RedirectResponse
    {
        if (session(self::SESSION_KEY_ROLE) !== 'landlord') {
            return redirect()->route('register');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'regex:'.self::PHONE_REGEX, 'unique:users,phone'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        session([self::SESSION_KEY_LANDLORD => $validated]);

        return redirect()->route('register.landlord.documents');
    }

    public function showLandlordDocuments(Request $request): View|RedirectResponse
    {
        if (session(self::SESSION_KEY_ROLE) !== 'landlord' || ! session(self::SESSION_KEY_LANDLORD)) {
            return redirect()->route('register');
        }

        return view('auth.register.landlord-documents');
    }

    public function storeLandlordDocuments(Request $request): RedirectResponse
    {
        if (session(self::SESSION_KEY_ROLE) !== 'landlord' || ! session(self::SESSION_KEY_LANDLORD)) {
            return redirect()->route('register');
        }

        $request->validate([
            'nida' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'electricity_bill' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        $details = session(self::SESSION_KEY_LANDLORD);

        $user = User::create([
            'name' => $details['name'],
            'email' => $details['email'],
            'phone' => $details['phone'],
            'password' => Hash::make($details['password']),
            'status' => User::STATUS_PENDING,
        ]);

        $user->assignRole('landlord');

        $basePath = 'landlord-documents/'.$user->id;

        $nidaPath = $request->file('nida')->store($basePath, 'local');
        $user->landlordDocuments()->create([
            'type' => LandlordDocument::TYPE_NIDA,
            'path' => $nidaPath,
            'original_name' => $request->file('nida')->getClientOriginalName(),
        ]);

        $billPath = $request->file('electricity_bill')->store($basePath, 'local');
        $user->landlordDocuments()->create([
            'type' => LandlordDocument::TYPE_ELECTRICITY_BILL,
            'path' => $billPath,
            'original_name' => $request->file('electricity_bill')->getClientOriginalName(),
        ]);

        event(new Registered($user));

        $this->clearRegistrationSession();

        return redirect()->route('register.pending');
    }

    public function showPending(): View
    {
        return view('auth.register.pending');
    }

    private function clearRegistrationSession(): void
    {
        session()->forget([self::SESSION_KEY_ROLE, self::SESSION_KEY_LANDLORD]);
    }
}
