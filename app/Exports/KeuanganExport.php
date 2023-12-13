<?php

namespace App\Exports;

use App\Models\Finance;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KeuanganExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    public function collection()
    {
        return Finance::select(
            'keterangan',
            'jumlah_uang',
            'created_at')
            ->get();
    }

    public function headings(): array
    {
        // Tentukan judul kolom di Excel
        return [
            'KETERANGAN',
            'JUMLAH UANG',
            'TANGGAL',
            // ... tambahkan judul kolom lainnya sesuai kebutuhan
        ];
    }

    public function map($row): array
    {
        // Map setiap baris ke kolom yang sesuai
        return [
            $row->keterangan,
            $row->jumlah_uang,
            $row->created_at,
            // ... tambahkan kolom lainnya sesuai kebutuhan
        ];
    }
}
