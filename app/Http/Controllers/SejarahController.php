<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function index()
    {
        // Nanti bisa ambil data dari database, sementara tampilkan view saja
        return view('sejarah');
    }
}
