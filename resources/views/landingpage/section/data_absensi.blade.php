@extends('landingpage.layout.index')
@section('content')
    <section id="hero-static" class="hero-static d-flex align-items-center">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
            <h2><span>Data Absen</span></h2>
            <p>Sudah Absen? Yuk Cek Data Di Bawah Ini</p>
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
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Lampiran Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAbsensi as $item)
                            <tr>
                                <th>{{ $no++ }}.</th>
                                @if ($item->status == 'Alpha')
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('LLL') }}</td>
                                @else
                                    <td>{{ \Carbon\Carbon::parse($item->time_in)->locale('id')->isoFormat('LLL') }}</td>
                                @endif
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->keterangan }}</td>
                                @if ($item->lampiran == NULL)
                                    <td>-</td>
                                @else
                                    <td><a href="/storage/{{ $item->lampiran }}" target="_blank"
                                            class="btn btn-info"><b>Lihat Lampiran Surat</b></a></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </section>
@endsection
