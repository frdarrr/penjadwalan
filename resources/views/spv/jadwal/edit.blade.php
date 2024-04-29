
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 ">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header">Edit Jadwal</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('jadwal.update',$jadwal->id) }}">
                        @csrf
                        @method('PUT')


                        <div class="form-group row mb-3">
                            <label for="nip" class="col-md-4 col-form-label text-md-right">Nama Dosen</label>

                            <div class="col-md-6">
                                <select class="form-select" id="dosen_id" name="dosen_id">
                                    <option hidden>{{ $jadwal->dosen->nama }}</option>
                                    @foreach ($dosen as $value)
                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="nip" class="col-md-4 col-form-label text-md-right">Matakuliah</label>

                            <div class="col-md-6">
                                <select class="form-select" id="kd_matkul" name="kd_matkul">
                                    <option hidden>{{ $jadwal->matkul->nama_matkul }}</option>
                                    @foreach ($matkul as $value)
                                    <option value="{{$value->kd_matkul}}">{{$value->nama_matkul}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="nip" class="col-md-4 col-form-label text-md-right">Matakuliah</label>

                            <div class="col-md-6">
                                <select class="form-select" id="lab_id" name="lab_id">
                                    <option hidden>{{ $jadwal->lab->desk_lab }}</option>
                                    @foreach ($lab as $value)
                                    <option value="{{$value->id}}">{{$value->desk_lab}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="hari" class="col-md-4 col-form-label text-md-right">Hari</label>

                            <div class="col-md-6">
                                <input id="hari" type="text" value="{{ $jadwal->hari }}" class="form-control{{ $errors->has('hari') ? ' is-invalid' : '' }}" name="hari" value="{{ old('hari') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="jam" class="col-md-4 col-form-label text-md-right">Jam</label>

                            <div class="col-md-6">
                                <input id="jam" type="text" value="{{ $jadwal->jam }}" class="form-control{{ $errors->has('jam') ? ' is-invalid' : '' }}" name="jam" value="{{ old('jam') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="kelas" class="col-md-4 col-form-label text-md-right">Kelas</label>

                            <div class="col-md-6">
                                <input id="kelas" type="text" value="{{ $jadwal->kelas }}" class="form-control{{ $errors->has('kelas') ? ' is-invalid' : '' }}" name="kelas" value="{{ old('kelas') }}" required autofocus>
                            </div>
                        </div>
                         <div class="form-group row mb-3 mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('jadwal.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
