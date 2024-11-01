<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function index()
    {
        return view('user.login');
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Email atau password salah!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function registration()
    {
        return view('user.registration');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|max:255'
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('user.registration')->with('success', 'Registrasi Berhasil!');
    }

    public function profile()
    {
        $data = Auth::user();
        return view('user.profile', compact('data'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns'
        ]);

        User::where('id', Auth::user()->id)->update($data);

        return redirect()->route('user.profile')->with('success', 'Data berhasil diubah!');
    }
}
