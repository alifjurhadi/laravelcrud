<?php  

use App\Models\Guru;
use App\Models\Siswa;

function limaBesar()
{
    $siswa = Siswa::all();
    $siswa->map(function ($s) {
        $s->rataRataNilai = $s->rataRataNilai();
        return $s;
    });
    $siswa = $siswa->sortByDesc('rataRataNilai')->take(5);
    return $siswa;
}

function totalSiswa()
{
    return Siswa::count();
}

function totalGuru()
{
    return Guru::count();
}