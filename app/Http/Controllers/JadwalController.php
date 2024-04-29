<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Lab;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            $jadwal = Jadwal::all();
        } else {
            $dosen = Dosen::where('user_id', '=', $user->id)->first();
            // mengambil data pegawai
            $jadwal = Jadwal::where('dosen_id', '=', $dosen->id)->get();
        }
        // mengirim data pegawai ke view pegawai
        return view('spv.jadwal.index', ['jadwal' => $jadwal]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dosen = Dosen::where('user_id', '=', Auth::user()->id)->first();
        $lab = Lab::all();
        $matkul = Matkul::all();
        return view('spv.jadwal.create', [
            'dosen' => $dosen,
            'matkul' => $matkul,
            'lab' => $lab,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedJadwal = $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'kd_matkul' => 'required|exists:matkuls,kd_matkul',
            'lab_id' => 'required|exists:labs,id',
            'hari' => 'required|max:255',
            'jam' => 'required|max:255',
            'kelas' => 'required|max:255',
        ]);
        try {
            $jadwal = Jadwal::create($validatedJadwal);
            return redirect()->route('jadwal.index')
                ->with(['success' => 'Show is successfully saved']);
        } catch (\Throwable $th) {
            return redirect()->route('jadwal.index')
                ->with(['error' => 'Show is failed saved']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        // dd($jadwal);
        $dosen = Dosen::all();
        $lab = Lab::all();
        $matkul = Matkul::all();
        return view('spv.jadwal.edit',[
            'jadwal' => $jadwal,
            'dosen' => $dosen,
            'matkul' => $matkul,
            'lab' => $lab,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'kd_matkul' => 'required|exists:matkuls,kd_matkul',
            'lab_id' => 'required|exists:labs,id',
            'hari' => 'required|max:255',
            'jam' => 'required|max:255',
            'kelas' => 'required|max:255',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')
                        ->with(['success' => 'Product updated successfully']);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')
                        ->with(['success' => 'Product deleted successfully']);
    }
}
