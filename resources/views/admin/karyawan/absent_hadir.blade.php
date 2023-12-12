@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>DATA KARYAWAN</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/karyawan') }}">Data Karyawan</a></li>
                    <li class="breadcrumb-item active">Data Absen Karyawan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    @include('admin.karyawan.menu_bar_absent')

                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-title mb-0 pb-0">Nama Karyawan : {{ $namaKaryawan->name }}</h6>
                            <h6 class="card-title mb-0 pb-0">Jumlah Hadir : {{ $jumlahHadir }} </h6>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Absent Hadir</h5>

                            <!-- Default Table -->
                            <table class="table" style="vertical-align: middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hadir as $item)
                                        <tr>
                                            <th>{{ $no++ }}.</th>
                                            <td>{{ \Carbon\Carbon::parse($item->time_in)->locale('id')->isoFormat('LLL') }}</td>
                                            <td>{{ $item->keterangan }}.</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Default Table Example -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
