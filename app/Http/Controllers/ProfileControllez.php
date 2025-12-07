<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        // Breeze default profile page
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        // Abhi assignment ke liye profile edit zaroori nahi,
        // isliye isko simple chhod sakte ho ya Breeze ka default use kar sakti ho.
        return back();
    }

    public function destroy(Request $request)
    {
        // Same – basic implementation.
        return redirect('/');
    }
}
