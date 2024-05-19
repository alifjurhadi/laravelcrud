@extends('layouts.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Data Siswa</h3>
                                <div class="right">
                                    <a href="/siswa/exportExcel" class="btn btn-sm btn-success">Export Excel</a>
                                    <a href="/siswa/exportPDF" class="btn btn-sm btn-danger">Export PDF</a>

                                    <button type="button" class="btn" data-toggle="modal"
                                        data-target="#exampleModal">Tambah Siswa <i class="lnr lnr-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>NAMA LENGKAP</th>
                                            <th>JENIS KELAMIN</th>
                                            <th>AGAMA</th>
                                            <th>ALAMAT</th>
                                            <th>NILAI RATA²</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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
                    <form action="/siswa/create" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('nama_depan') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">Nama Depan</label>
                            <input type="text" class="form-control" name="nama_depan" id="nama_depan"
                                aria-describedby="emailHelp" placeholder="Nama Depan" value="{{ old('nama_depan') }}" required>
                            @if ($errors->has('nama_depan'))
                                <span class="help-block">{{ $errors->first('nama_depan') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('nama_belakang') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">Nama Belakang</label>
                            <input type="text" class="form-control" name="nama_belakang" id="nama_belakang"
                                aria-describedby="emailHelp" placeholder="Nama Belakang"
                                value="{{ old('nama_belakang') }}" required>
                            @if ($errors->has('nama_belakang'))
                                <span class="help-block">{{ $errors->first('nama_belakang') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                aria-describedby="emailHelp" placeholder="Email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
                            <label for="exampleFormControlSelect1">Pilih Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="L"{{ old('jenis_kelamin') == 'L' ? ' selected' : '' }}>Laki-Laki
                                </option>
                                <option value="P"{{ old('jenis_kelamin') == 'P' ? ' selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @if ($errors->has('jenis_kelamin'))
                                <span class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('agama') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">Agama</label>
                            <input type="text" class="form-control" name="agama" id="agama"
                                aria-describedby="emailHelp" placeholder="Agama" value="{{ old('agama') }}" required>
                            @if ($errors->has('agama'))
                                <span class="help-block">{{ $errors->first('agama') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="exampleFormControlTextarea1">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ old('alamat') }}</textarea>
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
    $(document).ready(function(){
        $('#datatable').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('get.data.siswa') }}",
            columns:[
                {data:'nama_lengkap', name:'nama_lengkap'},
                {data:'jenis_kelamin', name:'jenis_kelamin'},
                {data:'agama', name:'agama'},
                {data:'alamat', name:'alamat'},
                {data:'rata2_nilai', name:'rata2_nilai'},
                {data:'aksi', name:'aksi'}
            ]
        });

        $('body').on('click','.delete',function(){
            var siswa_id = $(this).attr('siswa-id');
            swal({
            title: "Yakin ?",
            text: "Data siswa ini akan di hapus dengan id "+siswa_id + " ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
             if (willDelete) {
                window.location = "/siswa/"+siswa_id+"/delete";  
             } 
        });
    });
});
</script>
@stop