<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Method to display the PKL form
    public function showMandiri()
    {
        return view('mandiri'); 
    }

    public function showPemetaan()
    {
        return view('pemetaan'); 
    }

    public function submitForm(Request $request)
    {
        return view ('formpengajuan');

        $validated = $request->validate([
            'nis' => 'required|string',
            'name' => 'required|string',
            'jurusan' => 'required|string',
            'no_handphone' => 'required|string',
            'rencana_tempat_pkl' => 'required|string',
            'proposal_pkl' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        return redirect()->route('formpengajuan')->with('Berhasil', 'Pengajuan PKL berhasil dikirim!');
        return view ('mandiri');
    }

    public function laporanJurnal() 
    {
        return view ('laporanpkl_jurnal');
    }

    public function nextJurnal(Request $request)
    {
        // Mengambil data jurnal dengan pagination, sesuaikan modelnya
        $jurnals = Jurnal::paginate(10); // Menampilkan 10 item per halaman

        // Mengembalikan view dengan data jurnal
        if ($request->ajax()) {
            return view('partials.jurnal_table', compact('jurnals'))->render();
        }

        return view('jurnal.nextJurnal', compact('jurnals'));
    }

}
