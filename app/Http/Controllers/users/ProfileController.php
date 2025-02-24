<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('users.profile');
    }

    public function update(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        $user = User::find(Auth::id()); // Ensure we get an Eloquent model

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
