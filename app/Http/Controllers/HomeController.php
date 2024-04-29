<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $jadwal = null;
        $dosen = Dosen::where('user_id', '=', $user->id)->first();
        if ($dosen) {
            $jadwal = Jadwal::where('dosen_id', '=', $dosen->id)->get();
        }
        return view($user->role == 'admin'?'home':'spv.jadwal.index',[
            'dosen' => $dosen,
            'jadwal' => $jadwal
        ]);
    }
}
