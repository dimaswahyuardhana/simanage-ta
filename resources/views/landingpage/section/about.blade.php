@extends('landingpage.layout.index')
@section('content')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

          <div class="section-header">
            <h2>Tentang Aplikasi</h2>
          </div>

          <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-5">
              <div class="about-img">
                <img src="{{ asset('page/assets/img/about.jpg') }}" class="img-fluid" alt="">
              </div>
            </div>

            <div class="col-lg-7">

              <!-- Tab Content -->
              <div class="tab-content">

                <div class="tab-pane fade show active" id="tab1">

                  <p class="fst-italic">SiManage adalah aplikasi berbasis website untuk mengelola administrasi usaha. berikut ini tentang SiManage</p>

                  <div class="d-flex align-items-center mt-4">
                    <i class="bi bi-check2"></i>
                    <h4>Pengelolaan Administrasi Usaha</h4>
                  </div>
                  <p>SiManage memiliki fitur untuk mengelola administrasi usaha. pemilik usaha bisa menggunakan aplikasi ini dan login menjadi admin serta atur administrasi usaha dengan SiManage mulai dari pengelolaan data karyawan, absen karyawan, dan mengelola keuangan usaha</p>

                  <div class="d-flex align-items-center mt-4">
                    <i class="bi bi-check2"></i>
                    <h4>Absen Karyawan</h4>
                  </div>
                  <p>Karyawan bisa menggunakan aplikasi SiManage dengan login sebagai employee dan melakukan absensi dengan mudah.</p>

                  <div class="d-flex align-items-center mt-4">
                    <i class="bi bi-check2"></i>
                    <h4>Riwayat Absensi</h4>
                  </div>
                  <p>Karyawan bisa melakukan cek riwayat absensi melalui aplikasi SiManage jadi laporan menjadi transparan</p>

                  <div class="d-flex align-items-center mt-4">
                    <i class="bi bi-check2"></i>
                    <h4>Riwayat Gaji</h4>
                  </div>
                  <p>Karyawan bisa melakukan cek gaji apakah gaji sudah dibayarkan atau belum menggunakan aplikasi SiManage</p>

                </div><!-- End Tab 1 Content -->

              </div>

            </div>

          </div>

        </div>
      </section><!-- End About Section -->
@endsection
