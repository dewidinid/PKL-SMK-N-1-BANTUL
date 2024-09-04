<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function indexPembimbing()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('home_pembimbing');
    }
}
