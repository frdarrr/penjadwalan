@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            {{-- @session('success') --}}
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    Data Berhasil Disimpan
                </div>
            @endif
            {{-- @endsession
            @session('error') --}}
            @if (session('error'))  
                <div class="alert alert-danger" role="alert">
                    Data Gagal Disimpan
                </div>
            @endif
            {{-- @endsession --}}
            <div class="card">
            <div class="card-header">
                @if (Auth::user()->role === 'dosen')
                <a href="{{{ route('jadwal.create') }}}" class="btn btn-outline-primary">ADD</a> 
                @else
                @endif
                List Jadwal 
            </div>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-outline-success">Refresh</a>

                <div class="card-body">
                    <table align="center" class="table table-responsive">
                        <tr>
                            <th>No</th>
                            <th>Dosen</th>
                            <th>Matkul</th>
                            <th>Laboratorium</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>

                        @php
                            $no=1;
                        @endphp
                        @foreach ($jadwal as $jadwal)

                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$jadwal->dosen->nama}}</td>
                                <td>{{$jadwal->matkul->nama_matkul}}</td>
                                <td>{{$jadwal->lab->desk_lab}}</td>
                                <td>{{$jadwal->hari}}</td>
                                <td>{{$jadwal->jam}}</td>
                                <td>{{$jadwal->kelas}}</td>
                                <td>
                                    <a href="{{ route('jadwal.edit',$jadwal->id) }}" class="btn btn-outline-warning">Edit</a>
                                </td>
                                <td>
                                        <form action="{{ route('jadwal.destroy', $jadwal->id )}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button class="btn btn-outline-danger" type="submit"  onclick="return confirm('Apakah Anda Ingin Menghapus Data jadwal {{$jadwal->id}}');">Delete</button>
                                        </form>
                                </td>
                            </tr>

                        @php
                            $no++
                        @endphp
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
