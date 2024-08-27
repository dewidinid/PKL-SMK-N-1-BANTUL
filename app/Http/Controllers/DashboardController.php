<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('dashboard');
    }
}
