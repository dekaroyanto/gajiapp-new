<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawancount = Karyawan::count();
        return view('dashboard', compact('karyawancount'));
    }
}
