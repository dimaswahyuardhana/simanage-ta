@extends('landingpage.layout.index')
@section('content')
    <section id="hero-static" class="hero-static d-flex align-items-center">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
            <h2><span>Absen Karyawan</span></h2>
            <p>Absen Lebih Mudah dengan SiManage</p>
        </div>
    </section>
    <section class="page-section " id="contact">
        <div class="container">

            <center>
                <div class="box">
                    <div class="container_calendar">
                        <div class="row">
                            <div class="dycalendar col mx-4 mb-4" id="dycalendar"></div>

                            <div class="col mt-5">
                                <form method="POST" action="{{ route('absent') }}" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <label>
                                        <input type="radio" name="status" value="Hadir" checked>
                                        Hadir
                                    </label>
                                    <label>
                                        <input type="radio" name="status" value="Izin">
                                        Izin
                                    </label>
                                    <label>
                                        <input type="radio" name="status" value="Sakit">
                                        Sakit
                                    </label>

                                    <div class="col-sm-12 mt-2">
                                        <label for="keterangan">Keterangan :</label>
                                        <textarea name="keterangan" id="keterangan" cols="25" rows="3"
                                            class="form-control @error('keterangan') is-invalid @enderror"></textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row mb-3 me-2 mt-3">
                                        <label for="lampiran" class="col-sm-4 col-form-label">Lampiran Surat</label>
                                        <div class="col-sm-8">
                                            <input class="form-control @error('lampiran') is-invalid @enderror"
                                                type="file" name="lampiran" id="lampiran">
                                            <p class="tutorial-note">Dapat diisi dengan Lampiran Surat Izin atau Sakit</p>
                                            @error('lampiran')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <input type="hidden" name="distance" id="distance" value=>

                                    <button class="btn btn-info">Submit</button>
                                </form>

                            </div>

                        </div>

                    </div>

            </center>
        </div>
    </section>
    {{-- Calendar Script --}}
    <script src="https://cdn.jsdelivr.net/npm/dycalendarjs@1.2.1/js/dycalendar.js"></script>
    <script src="{{ asset('landing/js/scripts_calendar.js') }}"></script>

    {{-- geoloc --}}
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/geolib@3.3.3/lib/index.min.js"></script>
    <script>
        function attendance() {
            var company = {!! json_encode($company) !!}

            // Mendapatkan lokasi employee saat ini
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // ini posisi saat ini
                    var userLatitude = position.coords.latitude;
                    var userLongitude = position.coords.longitude;

                    // ini posisi kantor
                    var office = {
                        longitude: company[0]['longitude'],
                        latitude: company[0]['latitude']
                    };

                    // ini jarak keduanya
                    var distance = geolib.getDistance(office, {
                        latitude: userLatitude,
                        longitude: userLongitude
                    });
                    console.log(distance)
                    document.getElementById('distance').value = distance

                });
            }
        }
        attendance()
    </script>
    </div>
@endsection
