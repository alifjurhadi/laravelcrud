@extends('layouts.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Ranking 5 besar</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>RANKING</th>
                                            <th>NAMA</th>
                                            <th>NILAI TERTINGGI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $ranking = 1;
                                        @endphp
                                        @foreach (limaBesar() as $s)
                                            <tr>
                                                <td>{{ $ranking }}</td>
                                                <td>{{ $s->nama_lengkap() }}</td>
                                                <td>{{ $s->rataRataNilai }}</td>
                                            </tr>
                                            @php
                                                $ranking++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-graduation-cap"></i></span>
                            <p>
                                <span class="number">{{ totalSiswa() }}</span>
                                <span class="title">Total Siswa</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-users"></i></span>
                            <p>
                                <span class="number">{{ totalGuru() }}</span>
                                <span class="title">Total Guru</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
