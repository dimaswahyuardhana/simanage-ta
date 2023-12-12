@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>LAPORAN KEUANGAN</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Laporan Keuangan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Keuangan</h5>
                            <a href="{{ url('/export') }}">
                                <button type="button" class="btn btn-success">
                                    <i class="bi bi-file-earmark-excel-fill">Export To Excel</i>
                                </button>
                            </a>
                            <div class="table-responsive">
                                <table class="table" style="vertical-align: middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Pemasukan</th>
                                            <th scope="col">Pengeluaran</th>
                                            <th scope="col">Hutang</th>
                                            <th scope="col">Laba</th>
                                            <th scope="col">Tanggal Masuk</th>
                                            {{-- <th scope="col">Detail</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <th>{{ $no++ }}.</th>
                                                <td>{{ $formatted_total_pemasukan[$key] }}</td>
                                                <td>{{ $formatted_total_pengeluaran[$key] }}</td>
                                                <td>{{ $formatted_total_hutang[$key] }}</td>
                                                <td>{{ $formatted_laba[$key] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('LLL') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Default Table Example -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
