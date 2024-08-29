<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login'); // Pastikan view 'login' sesuai dengan file Blade Anda
    }

    /**
     * Handle login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('nis', 'password', 'nip', 'kode_admin', 'kode_dudi');

        // Validasi input form
        $request->validate([
            'nis' => 'nullable|string',
            'password' => 'required|string',
            'nip' => 'nullable|string',
            'kode_admin' => 'nullable|string',
            'kode_dudi' => 'nullable|string',
        ]);

        // Proses login berdasarkan peran
        if (isset($credentials['nis'])) {
            if (Auth::attempt(['nis' => $credentials['nis'], 'password' => $credentials['password']])) {
                return redirect()->route('dashboard'); // Redirect to dashboard after login
            }
        } elseif (isset($credentials['nip'])) {
            if (Auth::attempt(['nip' => $credentials['nip'], 'password' => $credentials['password']])) {
                return redirect()->route('dashboard');
            }
        } elseif (isset($credentials['kode_admin'])) {
            if (Auth::attempt(['kode_admin' => $credentials['kode_admin'], 'password' => $credentials['password']])) {
                return redirect()->route('dashboard');
            }
        } elseif (isset($credentials['kode_dudi'])) {
            if (Auth::attempt(['kode_dudi' => $credentials['kode_dudi'], 'password' => $credentials['password']])) {
                return redirect()->route('dashboard');
            }
        }

        // Jika login gagal, redirect kembali ke form login dengan error
        return redirect()->route('login.form')->withErrors([
            'login' => 'Login failed, please check your credentials.',
        ]);
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }

    /**
     * Show the dashboard after login.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('dashboard'); // Ganti dengan view dashboard yang sesuai
    }
}
