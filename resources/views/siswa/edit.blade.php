@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Update Data Siswa</h3>
                            </div>
                            <div class="panel-body">
                                <form action="/siswa/{{ $siswa->id }}/update" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('nama_depan') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Nama Depan</label>
                                        <input type="text" class="form-control" name="nama_depan" id="nama_depan"
                                            aria-describedby="emailHelp" placeholder="Nama Depan"
                                            value="{{ $siswa->nama_depan }}" required>
                                        @if ($errors->has('nama_depan'))
                                            <span class="help-block">{{ $errors->first('nama_depan') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('nama_belakang') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Nama Belakang</label>
                                        <input type="text" class="form-control" name="nama_belakang" id="nama_belakang"
                                            aria-describedby="emailHelp" placeholder="Nama Belakang"
                                            value="{{ $siswa->nama_belakang }}" required>
                                        @if ($errors->has('nama_belakang'))
                                            <span class="help-block">{{ $errors->first('nama_belakang') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
                                        <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                            <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>
                                                Laki-Laki</option>
                                            <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>
                                                Perempuan</option>
                                        </select>
                                        @if ($errors->has('jenis_kelamin'))
                                            <span class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('agama') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Agama</label>
                                        <input type="text" class="form-control" name="agama" id="agama"
                                            aria-describedby="emailHelp" placeholder="Agama" value="{{ $siswa->agama }}" required>
                                        @if ($errors->has('agama'))
                                            <span class="help-block">{{ $errors->first('agama') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                                        <label for="exampleFormControlTextarea1">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ $siswa->alamat }}</textarea>
                                        @if ($errors->has('alamat'))
                                            <span class="help-block">{{ $errors->first('alamat') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                        <label for="exampleFormControlTextarea1">Avatar</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control">
                                        @if ($errors->has('avatar'))
                                            <span class="help-block">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('content1')
    <h1 class="text-center">Edit data siswa</h1>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <form action="/siswa/{{ $siswa->id }}/update" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Depan</label>
                    <input type="text" class="form-control" name="nama_depan" id="nama_depan"
                        aria-describedby="emailHelp" placeholder="Nama Depan" value="{{ $siswa->nama_depan }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Belakang</label>
                    <input type="text" class="form-control" name="nama_belakang" id="nama_belakang"
                        aria-describedby="emailHelp" placeholder="Nama Belakang" value="{{ $siswa->nama_belakang }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                        <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
                        <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Agama</label>
                    <input type="text" class="form-control" name="agama" id="agama"
                        aria-describedby="emailHelp" placeholder="Agama" value="{{ $siswa->agama }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3">{{ $siswa->alamat }}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
        </div>
    </div>
@endsection
