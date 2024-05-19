<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Models\Siswa;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});


// login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin']);

// logout
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth','checkRole:admin']],function(){
    
    // Table siswa
    Route::get('/siswa', [SiswaController::class, 'index']);
    
    Route::get('getdatasiswa', [SiswaController::class, 'getdatasiswa'])->name('get.data.siswa');
    
    // insert data
    Route::post('/siswa/create', [SiswaController::class, 'create']);
    
    // updatedata
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit']);
    Route::post('/siswa/{siswa}/update', [SiswaController::class, 'update']);
    
    // profile
    Route::get('/siswa/{siswa}/profile', [SiswaController::class, 'profile']);
    
    // delete data
    Route::get('/siswa/{siswa}/delete', [SiswaController::class, 'delete']);
    
    // Tambah nilai
    Route::post('/siswa/{id}/addnilai', [SiswaController::class, 'addnilai']);

    // delete mapel:
    Route::delete('/siswa/{id}/{idmapel}/deletemapel', [SiswaController::class, 'deletemapel']);

    // Export Excel:
    Route::get('/siswa/exportExcel', [SiswaController::class, 'exportExcel']);
    
    // Export PDF:
    Route::get('/siswa/exportPDF', [SiswaController::class, 'exportPDF']);
    
    // Table guru:
    Route::get('/guru', [GuruController::class, 'index']);
    
    // profile guru:
    Route::get('/guru/{id}/profile', [GuruController::class, 'profile']);

    // insert data guru:
    Route::post('/guru/create', [GuruController::class, 'create']);

    // update guru:
    Route::get('/guru/{id}/editguru', [GuruController::class, 'editguru']);
    Route::post('/guru/{id}/updateguru', [GuruController::class, 'updateguru']);

    // delete dataguru:
    Route::get('/guru/{id}/deleteguru', [GuruController::class, 'deleteguru']);
});

Route::group(['middleware' => ['auth','checkRole:admin,siswa']],function(){
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
});


// Route::get('getdatasiswa', [
//     'uses' => 'SiswaController@getdatasiswa',
//     'as' => 'ajax.get.data.siswa'
// ]);


