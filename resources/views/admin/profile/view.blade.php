@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Profile</h5>

                            <form method="POST" action="/profileAdmin">
                                @method('PUT')
                                @csrf
                                <div class="row mb-3">
                                    <label for="company_name" class="col-sm-2 col-form-label">Nama Company*</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            id="company_name" name="company_name"
                                            value="{{ $profileAdmin[0]->company_name }}">
                                        @error('company_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ $profileAdmin[0]->email }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alamat" class="col-sm-2 col-form-label">Company Code*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="company" name="company"
                                            value="{{ $profileAdmin[0]->id_company }}" disabled>
                                        <p class="tutorial-note">Kode ini untuk register 'Employee / Karyawan'</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            name="alamat" id="alamat" value="{{ $profileAdmin[0]->alamat }}" disabled>
                                        <p class="tutorial-note">Cari Alamat pada Peta di bawah melalui kolom 'Cari lokasi'</p>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <input type="text" class="form-control" name="alamat" id="alamatHidden"
                                    value="{{ $profileAdmin[0]->alamat }}" hidden>
                                <input type="hidden" name="latitude" id="latitude" value="{{ $profileAdmin[0]->latitude }}">
                                <input type="hidden" name="longitude" id="longitude" value="{{ $profileAdmin[0]->longitude }}">

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info">Simpan</button>
                                    </div>
                                </div>

                            </form>

                            <div id="map" style="height: 200px; width:100%"></div>

                            <div class="mt-2">
                                <input type="text" id="search" placeholder="Cari lokasi..." />
                                <button onclick="searchLocation()">Cari</button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- Script Map --}}
    <script>
        var profileAdmin = @json($profileAdmin)
    </script>
    <script src="{{ asset('template/assets/js/map.js') }}"></script>
@endsection
