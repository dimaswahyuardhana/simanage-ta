<?php

namespace App\Http\Controllers;

use App\Models\FinancialStatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialStatementController extends Controller
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
        $data = FinancialStatement::with('user')
            ->where('id_user', $user)
            ->get();
        // dd($user);

        $total_pemasukan = FinancialStatement::select('total_pemasukan')
            ->where('id_user', $user)
            ->get();
        $formatted_total_pemasukan = [];
        foreach ($total_pemasukan as $total_pemasukan) {
            $formatted_total_pemasukan[] = $this->formatMoney($total_pemasukan->total_pemasukan);
        }

        $total_pengeluaran = FinancialStatement::select('total_pengeluaran')
            ->where('id_user', $user)
            ->get();
        $formatted_total_pengeluaran = [];
        foreach ($total_pengeluaran as $total_pengeluaran) {
            $formatted_total_pengeluaran[] = $this->formatMoney($total_pengeluaran->total_pengeluaran);
        }

        $total_hutang = FinancialStatement::select('total_hutang')
            ->where('id_user', $user)
            ->get();
        $formatted_total_hutang = [];
        foreach ($total_hutang as $total_hutang) {
            $formatted_total_hutang[] = $this->formatMoney($total_hutang->total_hutang);
        }

        $laba = FinancialStatement::select('laba')
            ->where('id_user', $user)
            ->get();
        $formatted_laba = [];
        foreach ($laba as $laba) {
            $formatted_laba[] = $this->formatMoney($laba->laba);
        }

        return view('admin.laporan.view', compact('no', 'data', 'formatted_total_pemasukan', 'formatted_total_pengeluaran', 'formatted_total_hutang', 'formatted_laba'));
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
        //
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
     * @param  \App\Models\FinancialStatement  $financialStatement
     * @return \Illuminate\Http\Response
     */
    public function show(FinancialStatement $financialStatement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FinancialStatement  $financialStatement
     * @return \Illuminate\Http\Response
     */
    public function edit(FinancialStatement $financialStatement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FinancialStatement  $financialStatement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinancialStatement $financialStatement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinancialStatement  $financialStatement
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinancialStatement $financialStatement)
    {
        //
    }
}
