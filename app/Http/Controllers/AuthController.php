<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Pembimbing;
use App\Models\Dudi;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk menggunakan Hash

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
        $request->validate([
            'username1' => 'required|string',  // NIS siswa
            'password2' => 'required|string',
            'role' => 'required|string|in:siswa',  // Hanya validasi role 'siswa'
        ]);

        // Validasi login siswa
        if ($request->role === 'siswa') {
            $siswa = Siswa::where('NIS', $request->username1)->first();

            if (!$siswa) {
                // Jika NIS tidak ditemukan
                $request->session()->flash('error', 'NIS tidak ditemukan.');
                return back();
            }

            // Membuat password default dengan format pw[NIS]
            $defaultPassword = 'pw' . $siswa->NIS;

            // Cek apakah password sesuai
            try {
                if ($request->password2 === $defaultPassword || Hash::check($request->password2, $siswa->password)) {
                    Auth::guard('siswa')->login($siswa); // Pastikan menggunakan guard siswa

                    // Regenerate session untuk mencegah session fixation attacks
                    $request->session()->regenerate();

                    // Menyimpan pesan flash untuk SweetAlert
                    $request->session()->flash('success', 'Selamat datang, ' . $siswa->nama_siswa . '!');
                    return redirect()->route('home_siswa'); // Arahkan ke halaman home siswa setelah login berhasil
                } else {
                    // Jika password salah
                    $request->session()->flash('error', 'Password yang dimasukkan salah.');
                    return back();
                }
            } catch (\Exception $e) {
                // Jika ada kesalahan saat memeriksa password
                $request->session()->flash('error', 'Terjadi kesalahan saat memeriksa password.');
                return back();
            }
        }

        // Jika role tidak valid
        $request->session()->flash('error', 'Role tidak valid.');
        return back();
    }



    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout(); // Logout the user
        return redirect('/'); // Redirect to the main dashboard
    }
}
