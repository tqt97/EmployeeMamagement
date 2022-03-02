<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function update(User $user, Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required|same:password'
        ]);
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('users.index')->with('success', 'Change password successfully');
    }
}
