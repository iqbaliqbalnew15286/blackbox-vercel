<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('caffesalon.admin.dashboard');
    }

    public function curator()
    {
        return view('caffesalon.admin.curator');
    }

    public function user()
    {
        // Mengambil semua user (admin) beserta data sesi terakhirnya
        // Eager loading 'session' untuk performa yang lebih baik (menghindari N+1 query)
        $users = User::with('session')->get();

        return view('caffesalon.admin.user', compact('users'));
    }
}
