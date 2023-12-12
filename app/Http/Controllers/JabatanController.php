<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanController extends Controller
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
        $data = Jabatan::select()
            ->where('id_company', $perusahaan)
            ->where('jabatan', '!=', 'none')
            ->get();

        // $gaji = Jabatan::select('gaji')
        //     ->where('id_company', $perusahaan)
        //     ->where('id_jabatan', '!=', 1)
        //     ->get();

        // penyesuaian jabatan sesuai akun company ku comment dulu(masih salah)
        // uncomment aja kalo mau diubah
        // $perusahaan = Auth::user()->id_company;
        // $data1 = User::with('jabatan') //
        //     ->where('id_company', $perusahaan)
        //     ->where('id_jabatan', '!=', 1)
        //     ->get();
        // $data2 = Jabatan::where('id_company', $perusahaan) //
        //     ->where('id_jabatan', '!=', 1)
        //     ->get();
        // $data = $data1->merge($data2); //

        // // dd($data);

        // $gaji1 = User::with('jabatan') //
        //     ->where('id_company', $perusahaan)
        //     ->where('id_jabatan', '!=', 1)
        //     ->get();
        // $gaji2 = Jabatan::where('id_company', $perusahaan) //
        //     ->where('id_jabatan', '!=', 1)
        //     ->get();
        // $gaji = $gaji1->merge($gaji2); //

        $formatted_gaji = [];
        foreach ($data as $gaji) {
            // if ($gaji->jabatan) {
            $formatted_gaji[] = $this->formatMoney($gaji->gaji);
            // }
        }

        return view('admin.jabatan.view', compact('no', 'data', 'formatted_gaji'));
    }

    public function formatMoney($amount)
    {
        $formattedAmount = 'Rp ' . number_format($amount, 2, ',', '.');

        return $formattedAmount;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jabatan.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required',
            'gaji' => 'required|numeric'
        ], [
            'jabatan.required' => 'Jabatan harus diisi',
            'gaji.required' => 'Gaji harus diisi',
            'gaji.numeric' => 'Gaji harus berupa angka'
        ]);

        $perusahaan = Auth::user()->id_company;
        Jabatan::create([
            'jabatan' => $validated['jabatan'],
            'gaji' => $validated['gaji'],
            'id_company' => $perusahaan
        ]);

        return redirect('/jabatan')->with('success', 'Data berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id_jabatan)
    {
        $data = Jabatan::find($id_jabatan);

        return view('admin.jabatan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jabatan)
    {
        $validated = $request->validate([
            'jabatan' => 'required',
            'gaji' => 'required|numeric'
        ], [
            'jabatan.required' => 'Jabatan harus diisi',
            'gaji.required' => 'Gaji harus diisi',
            'gaji.numeric' => 'Gaji harus berupa angka'
        ]);

        Jabatan::where('id_jabatan', $id_jabatan)->update($validated);

        return redirect('/jabatan')->with('success', 'Data berhasil di Tambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jabatan)
    {
        $none = Jabatan::select('id_company', 'jabatan', 'id_jabatan')
            ->where('id_company', auth()->user()->id_company)
            ->where('jabatan', 'none')
            ->get();
        User::where('id_jabatan', $id_jabatan)->update([
            'id_jabatan' => $none[0]->id_jabatan
        ]);

        Jabatan::destroy($id_jabatan);
        return redirect('/jabatan')->with('success', 'Data berhasil di Hapus');
    }
}
