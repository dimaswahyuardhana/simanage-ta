<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LaporanExport;
use App\Exports\KeuanganExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }

    public function exportKeuangan()
    {
        return Excel::download(new KeuanganExport, 'keuangan.xlsx');
    }
}
