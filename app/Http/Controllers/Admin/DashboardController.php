<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard umum.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard'); // Bisa disesuaikan jika ada dashboard umum
    }

    /**
     * Menampilkan halaman admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function adminDashboard()
    {
        return view('admin.dashboard.index');
    }

    /**
     * Menampilkan halaman user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function userDashboard()
    {
        return view('user.dashboard.index'); // Sesuaikan lokasi file view untuk user dashboard
    }
}
