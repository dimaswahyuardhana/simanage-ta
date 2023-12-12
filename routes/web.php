<?php

use App\Http\Controllers\AbsentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DataAbsensiController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinancialStatementController;
use App\Http\Controllers\GajiKaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatGajiController;
use App\Http\Controllers\KirimEmail;
use App\Http\Controllers\ExportController;

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
    return view('dashboardlanding');
});

Route::get('/about', function () {
    return view('landingpage.section.about');
});

// register admin
Route::get('/register/admin', [LoginController::class, 'indexRegisAdmin']);
Route::post('/register/admin', [LoginController::class, 'registrasiAdmin']);

// register employee
Route::get('/register/Employee', [LoginController::class, 'indexRegisEmployee']);
Route::post('/register/Employee', [LoginController::class, 'registrasiEmployee']);

// login
Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login'])->name('login');

// admin
Route::middleware(['loginAs'])->group(function () {
    Route::get('/admin', function () {
        $employee = DB::table('users')->where('id_company', Auth::user()->id_company)->where('id_role', '!=', 1)->count();
        $job = DB::table('jabatans')->where('id_company', Auth::user()->id_company)->where('jabatan','!=','none')->count();
        return view('dashboardadmin', compact('employee', 'job'));
    });

    // jabatan
    Route::get('/jabatan', [JabatanController::class, 'index']);
    // add jabatan
    Route::get('/jabatan/add', [JabatanController::class, 'create']);
    Route::post('/jabatan', [JabatanController::class, 'store']);
    // edit jabatan
    Route::get('/jabatan/{id_jabatan}/edit', [JabatanController::class, 'edit']);
    Route::put('/jabatan/{id_jabatan}', [JabatanController::class, 'update']);
    // delete jabatan
    Route::get('jabatan/{id_jabatan}/delete', [JabatanController::class, 'destroy']);

    // karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::put('/karyawan/jabatan/edit/{id}', [KaryawanController::class, 'update']);
    Route::get('/karyawan/absent/{id}/hadir', [KaryawanController::class, 'hadir'])->name('hadir');
    Route::get('/karyawan/absent/{id}/izin', [KaryawanController::class, 'izin'])->name('izin');
    Route::get('/karyawan/absent/{id}/sakit', [KaryawanController::class, 'sakit'])->name('sakit');
    Route::get('/karyawan/absent/{id}/alpha', [KaryawanController::class, 'alpha'])->name('alpha');
    // delete karyawan
    Route::get('karyawan/{id}/delete', [KaryawanController::class, 'destroy']);

    // gaji karyawan
    Route::get('/gaji_karyawan', [GajiKaryawanController::class, 'index']);
    // detail gaji karyawan
    Route::get('/detail_gaji_karyawan/{id_user}', [GajiKaryawanController::class, 'detail_gaji'])->name('detail_gaji');
    // add gaji karyawan
    Route::get('/gaji_karyawan/add', [GajiKaryawanController::class, 'create']);
    Route::post('/gaji_karyawan', [GajiKaryawanController::class, 'store']);
    Route::get('/cetak-slip/{id}', [RiwayatGajiController::class, 'cetakSlip']);

    // keuangan
    Route::get('/keuangan', [FinanceController::class, 'index']);
    // add keuangan
    Route::get('/keuangan/add', [FinanceController::class, 'create']);
    Route::post('/keuangan', [FinanceController::class, 'store']);
    // edit keuangan
    Route::get('/keuangan/{id_finance}/edit', [FinanceController::class, 'edit']);
    Route::put('/keuangan/{id_finance}', [FinanceController::class, 'update']);
    // delete keuangan
    Route::get('keuangan/{id_finance}/delete', [FinanceController::class, 'destroy']);
    // arsipkan keuangan
    Route::post('/keuangan/arsipkan', [FinanceController::class, 'arsipkan'])->name('keuangan.arsipkan');

    // laporan keuangan
    Route::get('/laporan', [FinancialStatementController::class, 'index']);

    // profile company
    Route::get('/profileAdmin', [ProfileAdminController::class, 'index']);
    Route::put('/profileAdmin', [ProfileAdminController::class, 'update']);

    Route::get('/export', [ExportController::class, 'export']);
    Route::get('/exportkeuangan', [ExportController::class, 'exportKeuangan']);
});

// employee
Route::middleware(['loginAsEmployee'])->group(function () {
    Route::get('/absent', [AbsentController::class, 'index']);
    Route::put('/absent', [AbsentController::class, 'absent'])->name('absent');

    Route::get('/data_absensi', [DataAbsensiController::class, 'index']);

    Route::get('/riwayat_gaji', [RiwayatGajiController::class, 'index']);
    Route::get('/cetak-slip/{id}', [RiwayatGajiController::class, 'cetakSlip']);

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile', [ProfileController::class, 'update']);

});

Route::get('/kirimemail', [KirimEmail::class, 'index']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
