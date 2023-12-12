<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use app\Models\User;
use app\Models\GajiKaryawan;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;
        $perusahaan = Auth::user()->id_company;
        // $dataKaryawan = User::with('jabatan')
        $dataKaryawan = User::select()
            ->where('id_role', '!=', 1)
            ->where('id_company', $perusahaan)
            ->get();
        // dd($dataKaryawan);

        $jabatan = Jabatan::where('id_company', $perusahaan)
            ->get();

        return view('admin.karyawan.view', compact('no', 'dataKaryawan', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.karyawan.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('id', $id)->update(['id_jabatan' => $request->input('jabatan')]);

        return redirect('/karyawan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the item by ID
        $item = User::find($id);

        // Check if the item exists
        if (!$item) {
            return redirect('/karyawan')->with('error', 'Item not found.');
        }

        // Delete the item
        $item->delete();

        // Redirect with a success message
        return redirect('/karyawan')->with('success', 'Item deleted successfully.');
    }

    public function hadir($id)
    {
        $perusahaan = Auth::user()->id_company;
        $dataKaryawan = User::select()
            ->where('id_role', '!=', 1)
            ->where('id_company', $perusahaan)
            ->where('id', $id)
            ->get();
        // dd($dataKaryawan);

        $no = 1;

        $namaKaryawan = User::select('name')
            ->where('id_role', '!=', 1)
            ->where('id', $id)
            ->first();

        $dataAbsent = User::with('absents')
            ->where('id', $id)
            ->get();
        // dd($dataAbsent);

        $jumlahHadir = $dataAbsent[0]->absents
            ->where('status', 'Hadir')
            ->count();
        // dd($jumlahHadir);

        $hadir = $dataAbsent[0]->absents
            ->where('status', 'Hadir');
        // dd($hadir);

        return view('admin.karyawan.absent_hadir', compact('dataKaryawan', 'no', 'namaKaryawan', 'jumlahHadir', 'hadir'));
    }

    public function izin($id)
    {
        $perusahaan = Auth::user()->id_company;
        $dataKaryawan = User::select()
            ->where('id_role', '!=', 1)
            ->where('id_company', $perusahaan)
            ->where('id', $id)
            ->get();
        // dd($dataKaryawan);

        $no = 1;

        $namaKaryawan = User::select('name')
            ->where('id_role', '!=', 1)
            ->where('id', $id)
            ->first();

        $dataAbsent = User::with('absents')
            ->where('id', $id)
            ->get();
        // dd($dataAbsent);

        $jumlahIzin = $dataAbsent[0]->absents
            ->where('status', 'Izin')
            ->count();
        // dd($jumlahIzin);

        $izin = $dataAbsent[0]->absents
            ->where('status', 'Izin');
        // dd($izin);

        return view('admin.karyawan.absent_izin', compact('dataKaryawan', 'no', 'namaKaryawan', 'jumlahIzin', 'izin'));
    }

    public function sakit($id)
    {
        $perusahaan = Auth::user()->id_company;
        $dataKaryawan = User::select()
            ->where('id_role', '!=', 1)
            ->where('id_company', $perusahaan)
            ->where('id', $id)
            ->get();
        // dd($dataKaryawan);

        $no = 1;

        $namaKaryawan = User::select('name')
            ->where('id_role', '!=', 1)
            ->where('id', $id)
            ->first();

        $dataAbsent = User::with('absents')
            ->where('id', $id)
            ->get();
        // dd($dataAbsent);

        $jumlahSakit = $dataAbsent[0]->absents
            ->where('status', 'Sakit')
            ->count();
        // dd($jumlahSakit);

        $sakit = $dataAbsent[0]->absents
            ->where('status', 'Sakit');
        // dd($sakit);

        return view('admin.karyawan.absent_sakit', compact('dataKaryawan', 'no', 'namaKaryawan', 'jumlahSakit', 'sakit'));
    }

    public function alpha($id)
    {
        $perusahaan = Auth::user()->id_company;
        $dataKaryawan = User::select()
            ->where('id_role', '!=', 1)
            ->where('id_company', $perusahaan)
            ->where('id', $id)
            ->get();
        // dd($dataKaryawan);

        $no = 1;

        $namaKaryawan = User::select('name')
            ->where('id_role', '!=', 1)
            ->where('id', $id)
            ->first();

        $dataAbsent = User::with('absents')
            ->where('id', $id)
            ->get();
        // dd($dataAbsent);

        $jumlahAlpha = $dataAbsent[0]->absents
            ->where('status', 'Alpha')
            ->count();
        // dd($jumlahAlpha);

        $alpha = $dataAbsent[0]->absents
            ->where('status', 'Alpha');
        // dd($alpha);

        return view('admin.karyawan.absent_alpha', compact('dataKaryawan', 'no', 'namaKaryawan', 'jumlahAlpha', 'alpha'));
    }
}
