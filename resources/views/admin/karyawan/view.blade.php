@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>DATA KARYAWAN</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Karyawan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Karyawan</h5>

                            <!-- Default Table -->
                            <div class="table-responsive">
                                <table class="table" style="vertical-align: middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama Karyawan</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">Nomor Telepon</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataKaryawan as $item)
                                            <tr>
                                                <th>{{ $no++ }}.</th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    <form id="updateForm{{ $item->id }}"
                                                        action="karyawan/jabatan/edit/{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="jabatan" id="jabatanSelect{{ $item->id }}">
                                                            @foreach ($jabatan as $nama_jabatan)
                                                                <option value="{{ $nama_jabatan->id_jabatan }}"
                                                                    {{ $nama_jabatan->id_jabatan == $item->id_jabatan ? 'selected' : '' }}>
                                                                    {{ $nama_jabatan->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </form>

                                                    {{-- {{ dd($nama_jabatan->id_jabatan, $item->id_jabatan) }} --}}
                                                </td>
                                                <td>{{ $item->nomor_telepon }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td><a href="{{ route('hadir', ['id' => $item->id]) }}"
                                                        class="btn btn-xs btn-info"><b>Lihat Absen</b></a>
                                                    <a href="/karyawan/{{ $item->id }}/delete"
                                                        class="btn btn-xs btn-danger"
                                                        onclick="return confirm('Are u Sure?');"><i class="fa fa-trash"></i></a>
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

    <script>
        // Mendengarkan perubahan pada elemen select
        document.querySelectorAll('[id^="jabatanSelect"]').forEach((select) => {
            select.addEventListener('change', function() {
                const formId = this.id.replace('jabatanSelect', 'updateForm');
                document.getElementById(formId).submit(); // Mengirimkan formulir saat perubahan terjadi
            });
        });
    </script>
@endsection
