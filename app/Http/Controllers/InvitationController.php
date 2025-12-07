<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function invite(Request $request)
    {
        $request->validate([
            'name'       => ['required'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'role'       => ['required'],
            'company_id' => ['nullable', 'integer'],
        ]);

        $auth = $request->user();
        $role = $request->role;
        $companyId = $request->company_id;

        // Rule 1: SuperAdmin can’t invite an Admin in a new company
        if ($auth->role === 'SuperAdmin' && $role === 'Admin' && !$companyId) {
            abort(403, 'SuperAdmin cannot invite Admin in a new company.');
        }

        // Rule 2: Admin can’t invite Admin or Member in their own company
        if ($auth->role === 'Admin' && in_array($role, ['Admin', 'Member'])) {
            abort(403, 'Admin cannot invite Admin or Member in their own company.');
        }

        // Decide company id
        if (!$companyId) {
            $companyId = $auth->company_id;
        }

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            // For demo: static password. Real project me invite link banaoge.
            'password'   => Hash::make('password'),
            'role'       => $role,
            'company_id' => $companyId,
        ]);

        return back()->with('success', 'User invited/created successfully.');
    }
}
