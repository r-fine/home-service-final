<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show_unverified_providers()
    {
        $users = User::whereRoleIs('s_provider')->where('is_verified', 0)->get();

        return view('admin.verify_provider', compact('users'));
    }

    public function user_verification($id)
    {
        $user = User::find($id);
        if (!$user->is_verified) {
            $user->is_verified = 1;
            $user->save();
            return back()->with('success', 'User id ' . $user->id . ' is set verified');
        } else {
            $user->is_verified = 0;
            $user->save();
            return back()->with('success', 'User id ' . $user->id . ' is set unverified');
        }
    }
}
