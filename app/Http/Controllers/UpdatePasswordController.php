<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    public function edit()
    {
        return view('user.change-password');
    }

    public function update(Request $request)
    {
        $cek = Hash::check($request->old_password, Auth::user()->password);

        if (!$cek) {
            return back()->with('error', 'Password lama salah!');
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
