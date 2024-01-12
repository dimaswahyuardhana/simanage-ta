<?php

namespace App\Exports;

use App\Models\FinancialStatement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class LaporanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        $no = 1;
        $user = Auth::user()->id;
        return FinancialStatement::select(
            'total_pemasukan',
            'total_pengeluaran',
            'total_hutang',
            'laba',
            'tanggal')
            ->where('id_user', $user)
            ->get();

    }

    public function headings(): array
    {
        // Tentukan judul kolom di Excel
        return [
            'Total Pemasukan',
            'Total Pengeluaran',
            'Total Hutang',
            'Laba',
            'Tanggal',
            // ... tambahkan judul kolom lainnya sesuai kebutuhan
        ];
    }

    public function map($row): array
    {
        // Map setiap baris ke kolom yang sesuai
        return [
            $row->total_pemasukan,
            $row->total_pengeluaran,
            $row->total_hutang,
            $row->laba,
            $row->tanggal,
            // ... tambahkan kolom lainnya sesuai kebutuhan
        ];
    }

}
