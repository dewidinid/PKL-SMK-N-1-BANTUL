<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('home_admin');
    }
    
}
