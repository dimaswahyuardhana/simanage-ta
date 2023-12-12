@extends('landingpage.layout.index')
@section('content')
    <section id="hero-static" class="hero-static d-flex align-items-center">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
            <h2><span>Riwayat Gaji</span></h2>
            <p>Sudah Gajian Belum?</p>
        </div>
    </section>
    <section class="page-section bg-light" id="contact">
        <div class="container">

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-light" style="vertical-align: middle">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Gaji</th>
                            <th scope="col">Slip Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataGaji as $key => $item)
                            <tr>
                                <th>{{ $no++ }}.</th>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('LLL') }}</td>
                                <td>{{ $formatted_dataGaji[$key] }}</td>
                                <td>
                                    <a href="{{ url('/cetak-slip/' . $item->id_gaji_karyawan) }}" target="_blank"
                                        class="btn btn-info"><b>Lihat Slip Gaji</b></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </section>
@endsection
