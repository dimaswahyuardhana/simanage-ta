<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\GajiKaryawan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class GajiKaryawanController extends Controller
{
    public function formatMoney($amount)
    {
        $formattedAmount = 'Rp ' . number_format($amount, 2, ',', '.');

        return $formattedAmount;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;
        $perusahaan = Auth::user()->id_company;
        $karyawan = User::with('jabatan')
            ->where('id_role', '!=', 1)
            ->where('id_company', $perusahaan)
            ->get();

        $formatted_gaji = [];
        foreach ($karyawan as $gaji) {
            $formatted_gaji[] = $this->formatMoney($gaji->jabatan->gaji);
        }

        return view('admin.gaji_karyawan.view', compact('no', 'karyawan', 'formatted_gaji'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perusahaan = Auth::user()->id_company;
        $dataKaryawan = User::with('jabatan')
            ->with('absents')
            ->where('id_role', '!=', 1)
            ->where('id_company', $perusahaan)
            ->get();
        // dd($dataKaryawan);

        return view('admin.gaji_karyawan.add', compact('dataKaryawan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Ambil nilai nama_karyawan dari request
        $namaKaryawan = $request->input('nama_karyawan');
        $emailKaryawan = $request->input('email_karyawan');

        // Ambil nilai gaji_karyawan dari request
        $gajiKaryawan = $request->input('gaji_karyawan');

        // // Ambil nilai jumlah_hadir dari request
        // $jumlahHadir = $request->input('jumlah_hadir');

        // // Ambil nilai jumlah_izin dari request
        // $jumlahIzin = $request->input('jumlah_izin');

        // // Ambil nilai jumlah_sakit dari request
        // $jumlahSakit = $request->input('jumlah_sakit');

        // Ambil nilai jumlah_alpha dari request
        // $jumlahAlpha = $request->input('jumlah_alpha');

        // Ambil nilai id_user dari request
        $idUser = $request->input('id_user');

        // $totalGaji = ($jumlahHadir + $jumlahIzin + $jumlahSakit - $jumlahAlpha) / ($jumlahHadir + $jumlahIzin + $jumlahSakit) * $gajiKaryawan;
        $totalGaji = $gajiKaryawan; //- ($jumlahAlpha * 50000);

        $validated = $request->validate([
            'id_user' => 'required'
        ], [
            'id_user.required' => 'Karyawan harus dipilih',
        ]);

        $waktu = Carbon::now();
        $month = $waktu->format('M-Y');
        if($request->hasfile('bukti_transfer_gaji')){
            $file = $request->file('bukti_transfer_gaji');
            $extension = $file->getClientOriginalExtension();
            $filename = 'bukti_slip_gaji-' . $namaKaryawan . '-' . $month . '.' . $extension;
            $request->bukti_transfer_gaji = $file->storeAs('bukti_gaji', $filename);
        }


        GajiKaryawan::create([
            'nama_karyawan' => $namaKaryawan,
            'total_gaji' => $totalGaji,
            'bukti_transfer_gaji' => $request->bukti_transfer_gaji,
            'id_user' => $idUser
        ]);

        $gaji_karyawan = Finance::where('keterangan', 'Gaji Karyawan')
                                ->where('id_user',Auth()->user()->id)
                                ->get();

        if (count($gaji_karyawan) == 0) {
            Finance::create([
                'keterangan' => 'Gaji Karyawan',
                'jumlah_uang' => $totalGaji,
                'id_kategori' => 2,
                'id_user' => auth()->user()->id
            ]);
        } else {
            Finance::where('keterangan', 'Gaji Karyawan')
                    ->where('id_user',Auth()->user()->id)
                    ->update(['jumlah_uang' => $gaji_karyawan[0]->jumlah_uang + $totalGaji]);
        }

        $email = $emailKaryawan;
        $data = [
            'title' => 'Gaji Anda Sudah Dibayarkan',
            'url' => 'https://bootstrap.com',
        ];
        Mail::to($email)->send(new SendMail($data));
        return redirect('/gaji_karyawan')->with('success', 'Data Gaji Karyawan berhasil di Tambah');
    }

    public function detail_gaji($id_user)
    {
        $no = 1;
        $detail_gaji = GajiKaryawan::where('id_user', $id_user)
            ->get();

        // $gaji = User::with('gaji_karyawans')
        //     ->where('id_role', '!=', 1)
        //     ->where('id_company', $perusahaan)
        //     ->where('id', $karyawan)
        //     ->get();

        $formatted_gaji_bersih = [];

        foreach ($detail_gaji as $gaji_bersih) {
            $formatted_gaji_bersih[] = $this->formatMoney($gaji_bersih->total_gaji);
        }

        if (count($detail_gaji) > 0) {
            return view('admin.gaji_karyawan.detail_gaji', compact('no', 'detail_gaji', 'formatted_gaji_bersih'));
        } else {
            return redirect()->back()->with('error', 'Data Gaji masih Kosong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GajiKaryawan  $gajiKaryawan
     * @return \Illuminate\Http\Response
     */
    public function show(GajiKaryawan $gajiKaryawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GajiKaryawan  $gajiKaryawan
     * @return \Illuminate\Http\Response
     */
    public function edit(GajiKaryawan $gajiKaryawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GajiKaryawan  $gajiKaryawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GajiKaryawan $gajiKaryawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GajiKaryawan  $gajiKaryawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(GajiKaryawan $gajiKaryawan)
    {
        //
    }

    public function cetakSlip($id)
    {
        $dataGaji = GajiKaryawan::with('user')
            ->where('id_gaji_karyawan', $id)
            ->first();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('landingpage.section.slip-gaji', ['dataGaji' => $dataGaji]));
        $namafile = 'slip-gaji-' . $dataGaji->nama_karyawan . '.pdf';
        $mpdf->Output($namafile, 'D');
    }
}
