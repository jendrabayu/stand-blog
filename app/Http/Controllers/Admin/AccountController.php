<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('admin.account.edit_profile', compact('user'));
    }

    public function password()
    {
        return view('admin.account.edit_password');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email,' . $user->id],
            'avatar' => ['nullable', 'max:1000', 'image'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] =  $request->file('avatar')->store('avatars', 'public');
            if ($user->avatar != 'avatars/default.jpg') {
                Storage::delete('public/' . $user->avatar);
            }
        } else {
            $validated['avatar'] = $user->avatar;
        }

        $user->update($validated);

        return back()->with('success', 'Profile has been updated');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255', 'confirmed']
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password invalid!');
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password has been changed');
    }
}
