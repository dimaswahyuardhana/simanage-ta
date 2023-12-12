@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>KEUANGAN</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Keuangan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Keuangan</h5>
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <a href="{{ url('/keuangan/add') }}">
                                        <button type="button" class="btn btn-info">
                                            <i class="fa-solid fa-plus"></i> Tambah Data
                                        </button>
                                    </a>
                                    <a href="{{ url('/exportkeuangan') }}">
                                        <button type="button" class="btn btn-success">
                                            <i class="bi bi-file-earmark-excel-fill">Export To Excel</i>
                                        </button>
                                    </a>
                                </div>
                                <div>
                                    {{-- <button type="button" class="btn btn-success" id="arsipkanDataBtn"
                                        data-url="{{ route('keuangan.arsipkan') }}">
                                        Arsipkan Data <i class="fa-regular fa-folder-open"></i>
                                    </button> --}}
                                    <button type="button" class="btn btn-success" id="arsipkanDataBtn"
                                        data-url="{{ route('keuangan.arsipkan') }}">
                                        Arsipkan Data <i class="fa-regular fa-folder-open"></i>
                                    </button>
                                </div>
                            </div>
                            <br>

                            <!-- Default Table -->
                            <div class="table-responsive">
                                <table class="table" style="vertical-align: middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Jumlah Uang</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <th>{{ $no++ }}.</th>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $formatted_jumlah_uang[$key] }}</td>
                                                <td>{{ $item->category->kategori }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->locale('id')->isoFormat('LLL') }}
                                                </td>
                                                <td>
                                                    @if ($item->keterangan != 'Gaji Karyawan')
                                                        <a href="/keuangan/{{ $item->id_finance }}/edit"
                                                            class="btn btn-xs btn-warning"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="/keuangan/{{ $item->id_finance }}/delete"
                                                            class="btn btn-xs btn-danger"
                                                            onclick="return confirm('Are u Sure?');"><i
                                                                class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="2" style="text-align: center">Total Uang</th>
                                            <th>{{ $formatted_total_uang }}</th>
                                            <td colspan="3"></td>
                                        </tr>
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

    {{-- Button Axios --}}
    <script>
        document.getElementById('arsipkanDataBtn').addEventListener('click', function() {
            var url = this.getAttribute('data-url');
            axios.post(url)
                .then(function(response) {
                    // Handle response jika diperlukan
                    if (response.data.total_pemasukan || response.data.total_pengeluaran || response.data
                        .total_hutang) {
                        window.location.href = '/laporan';
                        window.localStorage.setItem('notificationMessage', 'Data berhasil di Arsipkan.');
                    } else {
                        throw new Error(toastr.error('Tidak ada Data yang dapat di Arsipkan.'));
                    }
                })
                .catch(function(error) {
                    // Handle error jika diperlukan
                    // console.error(error);
                });
        });
    </script>
@endsection
