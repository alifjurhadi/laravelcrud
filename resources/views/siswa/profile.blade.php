@extends('layouts.master')

@section('header')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@stop
@section('content')
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                {{-- @if (session('sukses'))
                    <div class="alert alert-success" role="alert">
                        {{ session('sukses') }}
                    </div>
                @endif --}}
                {{-- @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif --}}
                <div class="panel panel-profile">
                    <div class="clearfix">
                        <!-- LEFT COLUMN -->
                        <div class="profile-left">
                            <!-- PROFILE HEADER -->
                            <div class="profile-header">
                                <div class="overlay"></div>
                                <div class="profile-main">
                                    <img src="{{ $siswa->getAvatar() }}" class="img-circle" alt="Avatar"
                                        style="width:108px; ">
                                    <h3 class="name">{{ $siswa->nama_depan }}</h3>
                                    <span class="online-status status-available">Aktif</span>
                                </div>
                                <div class="profile-stat">
                                    <div class="row">
                                        <div class="col-md-4 stat-item">
                                            {{ $siswa->mapel->count() }} <span>Mata Pelajaran</span>
                                        </div>
                                        <div class="col-md-4 stat-item">
                                            {{ $siswa->rataRataNilai() }} <span>Nilai rata-rata</span>
                                        </div>
                                        <div class="col-md-4 stat-item">
                                            2174 <span>Points</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE HEADER -->
                            <!-- PROFILE DETAIL -->
                            <div class="profile-detail">
                                <div class="profile-info">
                                    <h4 class="heading">Data diri</h4>
                                    <ul class="list-unstyled list-justify">
                                        <li>Jenis Kelamin <span>{{ $siswa->jenis_kelamin }}</span></li>
                                        <li>Agama <span>{{ $siswa->agama }}</span></li>
                                        <li>Alamat <span>{{ $siswa->alamat }}</span></li>
                                    </ul>
                                </div>

                                <div class="text-center" style="margin-top: -15px;"><a
                                        href="/siswa/{{ $siswa->id }}/edit" class="btn btn-warning">Edit Profile</a>
                                </div>
                            </div>
                            <!-- END PROFILE DETAIL -->
                        </div>
                        <!-- END LEFT COLUMN -->
                        <!-- RIGHT COLUMN -->
                        <div class="profile-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Tambah Nilai
                            </button>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Mata Pelajaran</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>KODE</th>
                                                <th>NAMA</th>
                                                <th>SEMESTER</th>
                                                <th>NILAI</th>
                                                <th>GURU</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswa->mapel as $mapel)
                                                <tr>
                                                    <td>{{ $mapel->kode }}</td>
                                                    <td>{{ $mapel->nama }}</td>
                                                    <td>{{ $mapel->semester }}</td>
                                                    <td><a href="#" class="nilai" data-type="text"
                                                            data-pk="{{ $mapel->id }}" data-url="/api/siswa/{{ $siswa->id }}/editnilai"
                                                            data-title="Masukan nilai">{{ $mapel->pivot->nilai }}</a></td>
                                                    <td><a href="/guru/{{ $mapel->guru_id }}/profile">{{ $mapel->guru->nama }}</a></td>
                                                    <td><a href="#" class="btn btn-danger btn-sm deletemapel" data-siswa-id="{{ $siswa->id }}" data-mapel-id="{{ $mapel->id }}"><i class="bi bi-trash3-fill"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="panel">
                                <div id="chartNilai"></div>
                            </div>
                        </div>
                        <!-- END RIGHT COLUMN -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/siswa/{{ $siswa->id }}/addnilai" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <select class="form-control" name="mapel" id="mapel">
                                @foreach ($matapelajaran as $mp)
                                    <option value="{{ $mp->id }}">{{ $mp->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group{{ $errors->has('nilai') ? ' has-error' : '' }}">
                            <label for="exampleInputEmail1">Nilai</label>
                            <input type="text" class="form-control" name="nilai" id="nilai"
                                aria-describedby="emailHelp" placeholder="Nilai" value="{{ old('nilai') }}" required>
                            @if ($errors->has('nilai'))
                                <span class="help-block">{{ $errors->first('nilai') }}</span>
                            @endif
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        $('.deletemapel').click(function(){
            var siswa_id = $(this).data('siswa-id'); // Mendapatkan siswa_id dari atribut data-siswa-id
            var mapel_id = $(this).data('mapel-id'); // Mendapatkan mapel_id dari atribut data-mapel-id
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            
            swal({
                title: "Yakin?",
                text: "Data mapel ini akan dihapus dengan id " + mapel_id + "?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // Mengirim request DELETE ke route deletemapel dengan id siswa dan id mapel
                    $.ajax({
                        url: "/siswa/"+ siswa_id + "/" + mapel_id + "/deletemapel",
                        type: "DELETE",
                         headers: {
                            'X-CSRF-TOKEN': csrfToken // Menambahkan CSRF token ke header permintaan
                        },
                        success: function(response) {
                            console.log("Mapel berhasil dihapus");
                            // Tambahkan logika lain jika diperlukan, misalnya, menampilkan pesan sukses
                        },
                        error: function(xhr) {
                            console.log("Gagal menghapus mapel");
                            // Tangani kesalahan jika terjadi
                        }
                    });
                }
            });
        });
    </script>
    <script>
        Highcharts.chart('chartNilai', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Laporan Nilai Siswa',
            },
            xAxis: {
                categories: {!! json_encode($categories) !!},
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nilai'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Nilai',
                data: {!! json_encode($data) !!}
            }]
        });

        $(document).ready(function() {
            $('.nilai').editable();
        });
    </script>
@stop
