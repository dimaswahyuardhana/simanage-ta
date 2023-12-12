@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tambah Data Gaji Karyawan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/gaji_karyawan') }}">Data Gaji Karyawan</a></li>
                    <li class="breadcrumb-item active">Tambah Data Gaji Karyawan</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Data Gaji Karyawan</h5>

                            <form method="POST" action="{{ url('/gaji_karyawan') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-sm-11">
                                    <select class="form-select @error('id_user') is-invalid @enderror"
                                        aria-label="default select example" name="id_user" id="selectKaryawan">
                                        <option value="0" selected>Pilih Karyawan*</option>
                                        @foreach ($dataKaryawan as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="tutorial-note">Pilih Karyawan untuk menampilkan Data Karyawan</p>
                                    @error('id_user')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Karyawan</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="namaKaryawan"
                                            value=":">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="emailKaryawan"
                                            value=": ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nomor Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="teleponKaryawan"
                                            value=": ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="alamatKaryawan"
                                            value=": ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jabatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="jabatanKaryawan"
                                            value=": ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Gaji Pokok</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="gajiKaryawan"
                                            value=": ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jumlah Hadir</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="jumlahHadir"
                                            value=": ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jumlah Izin</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="jumlahIzin"
                                            value=": ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jumlah Sakit</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="jumlahSakit"
                                            value=": ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jumlah Alpha</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="jumlahAlpha"
                                            value=": ">
                                    </div>
                                </div>

                                <div class="row mb-3 me-2">
                                    <label for="bukti_transfer_gaji" class="col-sm-3 col-form-label">Bukti Slip Gaji</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('bukti_transfer_gaji') is-invalid @enderror"
                                            type="file" name="bukti_transfer_gaji" id="bukti_transfer_gaji">
                                        @error('bukti_transfer_gaji')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <input name="nama_karyawan" id="namaKaryawanInput" hidden>
                                <input name="email_karyawan" id="emailkaryawanInput" hidden>
                                <input name="gaji_karyawan" id="gajiKaryawanInput" hidden>
                                <input name="jumlah_hadir" id="jumlahHadirInput" hidden>
                                <input name="jumlah_izin" id="jumlahIzinInput" hidden>
                                <input name="jumlah_sakit" id="jumlahSakitInput" hidden>
                                <input name="jumlah_alpha" id="jumlahAlphaInput" hidden>
                                <input name="id_user" id="idUserInput" hidden>

                                <div class="row mt-3">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info">Tambah</button>
                                        <a class="btn btn-danger" href="{{ url('/gaji_karyawan') }}">Batal</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </section>

    </main>
    <script>
        var dataKaryawan = {!! json_encode($dataKaryawan) !!};
        console.log(dataKaryawan)
    </script>
    <script src="{{ asset('template/assets/js/gaji_karyawan.js') }}"></script>
@endsection
