@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">Update Data Guru</h3>
                            </div>
                            <div class="panel-body">
                                <form action="/guru/{{ $guru->id }}/updateguru" method="POST"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            aria-describedby="emailHelp" placeholder="Nama"
                                            value="{{ $guru->nama }}" required>
                                        @if ($errors->has('nama'))
                                            <span class="help-block">{{ $errors->first('nama') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('telpon') ? ' has-error' : '' }}">
                                        <label for="exampleInputEmail1">telpon</label>
                                        <input type="number" class="form-control" name="telpon" id="telpon"
                                            aria-describedby="emailHelp" placeholder="Telpon"
                                            value="{{ $guru->telpon }}" required>
                                        @if ($errors->has('telpon'))
                                            <span class="help-block">{{ $errors->first('telpon') }}</span>
                                        @endif    
                                    </div>
                                    <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                                        <label for="exampleFormControlTextarea1">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ $guru->alamat }}</textarea>
                                        @if ($errors->has('alamat'))
                                            <span class="help-block">{{ $errors->first('alamat') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
                                        <label for="exampleFormControlTextarea1">Foto</label>
                                        <input type="file" name="foto" id="foto" class="form-control" required>
                                        @if ($errors->has('foto'))
                                            <span class="help-block">{{ $errors->first('foto') }}</span>
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
