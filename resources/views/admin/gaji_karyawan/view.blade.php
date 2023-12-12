@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>DATA GAJI KARYAWAN</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Gaji Karyawan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Gaji Karyawan</h5>
                            <div>
                                <a href="{{ url('/gaji_karyawan/add') }}">
                                    <button type="button" class="btn btn-success">
                                        <i class="bi bi-cash-stack"></i> Bayar Gaji
                                    </button>
                                </a>
                            </div>
                            <br>

                            <!-- Default Table -->
                            <div class="table-responsive">
                                <table class="table" style="vertical-align: middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama Karyawan</th>
                                            <th scope="col">Gaji Pokok</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawan as $key => $item)
                                            <tr>
                                                <th>{{ $no++ }}.</th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $formatted_gaji[$key] }}</td>
                                                <td><a href="{{ route('detail_gaji', ['id_user' => $item->id]) }}"
                                                        class="btn btn-xs btn-info"><b>Riwayat Gaji</b></a>
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
