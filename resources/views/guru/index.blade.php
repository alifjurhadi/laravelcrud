@extends('layouts.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Data Guru</h3>
                                <div class="right">
                                    <button type="button" class="btn" data-toggle="modal"
                                        data-target="#exampleModal">Tambah Guru <i class="lnr lnr-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>NAMA</th>
                                            <th>TELPON</th>
                                            <th>ALAMAT</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_guru as $guru)
                                            <tr>
                                                <td><a href="/guru/{{ $guru->id }}/profile">{{ $guru->nama }}</a></td>
                                                <td>{{ $guru->telpon }}</td>
                                                <td>{{ $guru->alamat }}</td>
                                                <td>
                                                    <a href="/guru/{{ $guru->id }}/editguru"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm deleteguru" guru-id="{{ $guru->id }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/guru/create" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                aria-describedby="emailHelp" placeholder="Nama" value="{{ old('nama') }}" required>
                            @if ($errors->has('nama'))
                                <span class="help-block">{{ $errors->first('nama') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('telpon') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">Telpon</label>
                            <input type="number" class="form-control" name="telpon" id="telpon"
                                aria-describedby="emailHelp" placeholder="No telpon" value="{{ old('telpon') }}" required>
                            @if ($errors->has('telpon'))
                                <span class="help-block">{{ $errors->first('telpon') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="exampleFormControlTextarea1">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                            @if ($errors->has('alamat'))
                                <span class="help-block">{{ $errors->first('alamat') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
                            <label for="exampleFormControlTextarea1">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                            @if ($errors->has('foto'))
                                <span class="help-block">{{ $errors->first('foto') }}</span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    @stop

@section('footer')
<script>
    $('.deleteguru').click(function(){
        var guru_id = $(this).attr('guru-id');
        swal({
            title: "Yakin ?",
            text: "Data siswa ini akan di hapus dengan id "+guru_id +" ??",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/guru/"+guru_id+"/deleteguru";
            }
        });
     });
</script>
@stop