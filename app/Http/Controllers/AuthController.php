<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
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
            'role' => 'required|string|in:siswa,pembimbing,admin,dudi',  // Hanya validasi role 'siswa'
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

        // Validasi login Dudi
        if ($request->role === 'dudi') {
            $dudi = Dudi::where('kode_dudi', $request->username1)->first();

            if (!$dudi) {
                // Jika kode Dudi tidak ditemukan
                $request->session()->flash('error', 'Kode Dudi tidak ditemukan.');
                return back();
            }

            // Password default for Dudi
            $defaultPassword = 'skansaba123';

            // Cek apakah password sesuai
            try {
                if ($request->password2 === $defaultPassword || Hash::check($request->password2, $dudi->password)) {
                    Auth::guard('dudi')->login($dudi); // Login Dudi

                    // Set session ID berdasarkan kode dudi
                    //session(['user_id' => $dudi->kode_dudi]);

                    // Regenerate session for security
                    $request->session()->regenerate();

                    // Flash success message for SweetAlert
                    $request->session()->flash('success', 'Selamat datang, ' . $dudi->nama_dudi . '!');

                    return redirect()->route('home_dudi');
                } else {
                    $request->session()->flash('error', 'Password yang dimasukkan salah.');
                    return back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('error', 'Terjadi kesalahan saat memeriksa password.');
                return back();
            }
        }

        // Validasi login admin
        if ($request->role === 'admin') {
            $admin = Admin::where('kode_admin', $request->username1)->first();
        
            if (!$admin) {
                // Jika username admin tidak ditemukan
                $request->session()->flash('error', 'Username tidak ditemukan.');
                return back();
            }
        
            // Cek apakah password sesuai dengan hash yang tersimpan
            if (Hash::check($request->password2, $admin->password)) {
                // Login berhasil
                Auth::guard('admin')->login($admin); // Gunakan guard 'admin'
                
                // Regenerate session untuk keamanan
                $request->session()->regenerate();
        
                // Simpan kode_admin dalam session
                $request->session()->put('kode_admin', $admin->kode_admin);
        
                // Flash message untuk login berhasil
                $request->session()->flash('success', 'Selamat datang, ' . $admin->kode_admin . '!');
        
                // Redirect ke halaman home admin
                return redirect()->route('home_admin');
            } else {
                // Password salah
                $request->session()->flash('error', 'Password salah.');
                return back();
            }
        }                               

         // Validasi login pembimbing
         if ($request->role === 'pembimbing') {
            $pembimbing = Pembimbing::where('NIP_NIK', $request->username1)->first();

            if (!$pembimbing) {
                // Jika NIP/NIK tidak ditemukan
                $request->session()->flash('error', 'NIP/NIK tidak ditemukan.');
                return back();
            }

            // Password default
            $defaultPassword = 'skansaba123';

            // Cek apakah password sesuai
            if ($request->password2 === $defaultPassword || Hash::check($request->password2, $pembimbing->password)) {
                // Login pembimbing
                Auth::guard('pembimbing')->login($pembimbing);

                // Regenerate session untuk keamanan
                $request->session()->regenerate();

                $request->session()->put('nama_pembimbing', $pembimbing->nama_pembimbing);

                // Menyimpan pesan flash untuk SweetAlert
                $request->session()->flash('success', 'Selamat datang, ' . $pembimbing->nama_pembimbing . '!');

                return redirect()->route('home_pembimbing');
            } else {
                // Jika password salah
                $request->session()->flash('error', 'Password salah.');
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
