@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                    @if(Auth::user()->role==='dosen')
                    <table align="center" class="table table-responsive">
                        <tr>
                            <th>No</th>
                            <th>Dosen</th>
                            <th>Matkul</th>
                            <th>Laboratorium</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Kelas</th>
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
                            </tr>

                        @php
                            $no++
                        @endphp
                        @endforeach

                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
