<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Finance;
use App\Models\FinancialStatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;
        $user = Auth::user()->id;
        $data = Finance::with('category')
            ->with('user')
            ->where('id_user', $user)
            ->get();
        // dd($data);

        $jumlah_uang = Finance::select('jumlah_uang')
            ->with('user')
            ->where('id_user', $user)
            ->get();
        $formatted_jumlah_uang = [];
        foreach ($jumlah_uang as $jumlah_uang) {
            $formatted_jumlah_uang[] = $this->formatMoney($jumlah_uang->jumlah_uang);
        }

        $total_pemasukan = Finance::whereHas('category', function ($query) {
            $query->where('kategori', 'Pemasukan ( + )');
        })
            ->where('id_user', $user)
            ->sum('jumlah_uang');

        $total_pengeluaran = Finance::whereHas('category', function ($query) {
            $query->where('kategori', 'Pengeluaran ( - )');
        })
            ->where('id_user', $user)
            ->sum('jumlah_uang');

        $total_hutang = Finance::whereHas('category', function ($query) {
            $query->where('kategori', 'Hutang ( - )');
        })
            ->where('id_user', $user)
            ->sum('jumlah_uang');

        $total_uang = $total_pemasukan - $total_pengeluaran - $total_hutang;

        $formatted_total_uang = $this->formatMoney($total_uang);

        return view('admin.keuangan.view', compact('no', 'data', 'formatted_jumlah_uang', 'formatted_total_uang'));
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
        $data['categories'] = Category::all();

        return view('admin.keuangan.add', $data);
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
            'keterangan' => 'required',
            'jumlah_uang' => 'required|numeric',
            'id_kategori' => 'not_in:0'
        ], [
            'keterangan.required' => 'Keterangan harus diisi',
            'jumlah_uang.required' => 'Jumlah Uang harus diisi',
            'jumlah_uang.numeric' => 'Jumlah Uang harus berupa angka',
            'id_kategori.not_in' => 'Pilih Kategori yang sesuai',
        ]);

        $user = Auth::user()->id;
        $gaji_karyawan = Finance::where('keterangan', 'Gaji Karyawan')
            ->get();
        if (strtolower($validated['keterangan']) == 'gaji karyawan') {
            if ($validated['id_kategori'] == 2) {
                Finance::where('keterangan', 'Gaji Karyawan')->update([
                    'jumlah_uang' => $gaji_karyawan[0]->jumlah_uang + $validated['jumlah_uang']
                ]);
            }
            else {
                return redirect()->back()->with('error', 'Gaji Karyawan harus kategori Pengeluaran');
            }
        } else {
            Finance::create([
                'keterangan' => $validated['keterangan'],
                'jumlah_uang' => $validated['jumlah_uang'],
                'id_kategori' => $validated['id_kategori'],
                'id_user' => $user
            ]);
        }

        return redirect('/keuangan')->with('success', 'Data berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function edit($id_finance)
    {
        $data['categories'] = Category::all();
        $data['finance'] = Finance::find($id_finance);

        return view('admin.keuangan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_finance)
    {
        $validated = $request->validate([
            'keterangan' => 'required',
            'jumlah_uang' => 'required|numeric',
            'id_kategori' => 'not_in:0'
        ], [
            'keterangan.required' => 'Keterangan harus diisi',
            'jumlah_uang.required' => 'Jumlah Uang harus diisi',
            'jumlah_uang.numeric' => 'Jumlah Uang harus berupa angka',
            'id_kategori.not_in' => 'Pilih Kategori yang sesuai',
        ]);

        Finance::where('id_finance', $id_finance)->update($validated);

        return redirect('/keuangan')->with('success', 'Data berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_finance)
    {
        Finance::destroy($id_finance);
        return redirect('/keuangan')->with('success', 'Data berhasil di Hapus');
    }

    public function arsipkan(Request $request)
    {
        $user = Auth::user()->id;
        // dd($user);

        // Mengambil data dari tabel finances
        $total_pemasukan = Finance::whereHas('category', function ($query) {
            $query->where('kategori', 'Pemasukan ( + )');
        })
            ->with('user')
            ->where('id_user', $user)
            ->sum('jumlah_uang');
        // dd($total_pemasukan);

        $total_pengeluaran = Finance::whereHas('category', function ($query) {
            $query->where('kategori', 'Pengeluaran ( - )');
        })
            ->with('user')
            ->where('id_user', $user)
            ->sum('jumlah_uang');

        $total_hutang = Finance::whereHas('category', function ($query) {
            $query->where('kategori', 'Hutang ( - )');
        })
            ->with('user')
            ->where('id_user', $user)
            ->sum('jumlah_uang');

        $laba = $total_pemasukan - $total_pengeluaran - $total_hutang;

        // Memeriksa apakah setidaknya satu data memiliki nilai
        if ($total_pemasukan || $total_pengeluaran || $total_hutang) {
            $laba = $total_pemasukan - $total_pengeluaran - $total_hutang;

            // Memasukkan data ke dalam tabel financial_statements
            FinancialStatement::create([
                'total_pemasukan' => $total_pemasukan,
                'total_pengeluaran' => $total_pengeluaran,
                'total_hutang' => $total_hutang,
                'laba' => $laba,
                'tanggal' => now(),
                'id_user' => $user
            ]);

            // Menghapus data yang telah diarsipkan dari tabel finances
            Finance::whereHas('category', function ($query) {
                $query->whereIn('kategori', ['Pemasukan ( + )', 'Pengeluaran ( - )', 'Hutang ( - )']);
            })
                ->with('user')
                ->where('id_user', $user)
                ->delete();

            return response()->json([
                'total_pemasukan' => $total_pemasukan,
                'total_pengeluaran' => $total_pengeluaran,
                'total_hutang' => $total_hutang
            ]);
            // return redirect('/laporan')->with('success', 'Data berhasil di Arsipkan.');
        }
        // else {
        //     return redirect()->back()->with('error', 'Tidak ada Data yang dapat di Arsipkan.');
        //     return response()->json(['error' => 'Tidak ada Data yang dapat di Arsipkan.'], 400);
        // }
    }
}
