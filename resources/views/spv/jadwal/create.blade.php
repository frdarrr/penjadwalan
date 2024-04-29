
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
                <div class="card-header">Add New Jadwal</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('jadwal.store') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="dosen_id" class="col-md-4 col-form-label text-md-right">Nama Dosen</label>

                            <div class="col-md-6">
                                @if(Auth::user()->role == 'admin')
                                <select class="form-select" id="dosen_id" name="dosen_id">
                                    <option hidden>Pilih Nama Dosen</option>
                                    @foreach ($dosen as $value)
                                    <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                </select>
                                @else
                                <input id="dosen_id" type="hidden" value="{{$dosen->id}}" class="form-control{{ $errors->has('dosen') ? ' is-invalid' : '' }}" name="dosen_id" required>
                                <input id="dosen" type="text" disabled value="{{$dosen->nama}}" class="form-control{{ $errors->has('dosen') ? ' is-invalid' : '' }}" name="dosen" required>
                                @endif

                                @if ($errors->has('dosen_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dosen_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="matkul_id" class="col-md-4 col-form-label text-md-right">Mata Kuliah</label>

                            <div class="col-md-6">
                                <select class="form-select"  id="kd_matkul" name="kd_matkul">
                                    <option hidden>Pilih Matkul</option>
                                    @foreach ($matkul as $value)
                                    <option value="{{$value->kd_matkul}}">{{$value->nama_matkul}}</option>
                                @endforeach
                                </select>

                                @if ($errors->has('matkul_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('matkul_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="lab_id" class="col-md-4 col-form-label text-md-right">Nama Lab</label>

                            <div class="col-md-6">
                                <select class="form-select"  id="lab_id" name="lab_id">
                                    <option hidden>Pilih Nama Lab</option>
                                    @foreach ($lab as $value)
                                    <option value="{{$value->id}}">{{$value->desk_lab}}</option>
                                @endforeach
                                </select>

                                @if ($errors->has('lab_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lab_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="hari" class="col-md-4 col-form-label text-md-right">Hari</label>

                            <div class="col-md-6">
                                <input id="hari" type="text" class="form-control{{ $errors->has('hari') ? ' is-invalid' : '' }}" name="hari" value="{{ old('hari') }}" required autofocus>

                                @if ($errors->has('hari'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('hari') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="jam" class="col-md-4 col-form-label text-md-right">Jam</label>

                            <div class="col-md-6">
                                <input id="jam" type="text" class="form-control{{ $errors->has('jam') ? ' is-invalid' : '' }}" name="jam" value="{{ old('jam') }}" required>

                                @if ($errors->has('jam'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jam') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="kelas" class="col-md-4 col-form-label text-md-right">Kelas</label>
                             <div class="col-md-6">
                                <input id="kelas" type="text" class="form-control{{ $errors->has('kelas') ? ' is-invalid' : '' }}" name="kelas" required>

                                @if ($errors->has('kelas'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kelas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group row mb-3 mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ADD') }}
                                </button>
                                <a href="{{ route('dosen.index') }}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection