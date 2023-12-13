@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>DETAIL GAJI KARYAWAN</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/gaji_karyawan') }}">Data Gaji Karyawan</a></li>
                    <li class="breadcrumb-item active">Detail Gaji Karyawan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detail Gaji Karyawan</h5>
                            <div class="form-group row" style="font-size:18px; font-weight:bolder">
                                <label class="col-sm-1 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext" id="namaKaryawan"
                                        style="font-size:18px; font-weight:bolder"
                                        value=": {{ $detail_gaji[0]->nama_karyawan }}">
                                </div>
                            </div>

                            <!-- Default Table -->
                            <table class="table" style="vertical-align: middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Gaji Bersih</th>
                                        <th scope="col">Slip Gaji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail_gaji as $key => $item)
                                        <tr>
                                            <th>{{ $no++ }}.</th>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('LLL') }}
                                            <td>{{ $formatted_gaji_bersih[$key] }}</td>
                                            <td>
                                                @if ($item->bukti_transfer_gaji != null)
                                                <a href="/storage/{{ $item->bukti_transfer_gaji }}" target="_blank"
                                                    class="btn btn-xs btn-info"><b>Lihat Slip Gaji</b></a>
                                                @endif
                                                <a href="{{ url('/cetak-slip-gaji/' . $item->id_gaji_karyawan) }}" target="_blank">
                                                    <button class="btn btn-danger">
                                                        <i class="bi bi-file-earmark-pdf">CETAK SLIP GAJI PDF</i>
                                                    </button>
                                                </a>
                                            </td>
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
