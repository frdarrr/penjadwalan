<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// panggil model pegawai
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DosenController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // mengambil data pegawai
    	$dosen = Dosen::all();

    	// mengirim data pegawai ke view pegawai
    	return view('spv.dosen.index', ['dosen' => $dosen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('spv.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|max:255',
            'nama' => 'required|max:255',
            'telp' => 'required|numeric',
            'email' => 'required|max:255|unique:dosens',
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'dosen'
            ]);
            $validatedData['user_id'] = $user->id;
            $dosen = Dosen::create($validatedData);
            DB::commit();
            return redirect()->route('dosen.index')
                             ->with(['success' => 'Show is successfully saved']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('dosen.index')
                             ->with(['error' => 'data gagal']);
        }
        // return $request->all();
        
        // return redirect()->route('dosen.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        return view('spv.dosen.edit',compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'telp' => 'required',
            'email' => 'required',
        ]);

        $dosen->update($request->all());

        return redirect()->route('dosen.index')
                        ->with(['success' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        // $dosen = Dosen::findOrFail($id);
        // $dosen->delete();

        // return redirect('dosen.index')->with('success', 'Dosen is successfully deleted');

        $dosen->delete();

        return redirect()->route('dosen.index')
                        ->with(['success' => 'Product deleted successfully']);
    }
}
