<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * List users, optionally filtered by role (admin, tenant, landlord).
     */
    public function index(Request $request): View
    {
        $role = $request->query('role');
        $validRoles = ['admin', 'tenant', 'landlord'];

        $query = User::query()->with('roles')->orderBy('created_at', 'desc');

        if ($role && in_array($role, $validRoles, true)) {
            $query->role($role);
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users', 'role'));
    }
}
