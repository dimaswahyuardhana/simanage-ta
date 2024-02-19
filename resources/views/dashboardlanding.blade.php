@extends('landingpage.layout.index')
@section('content')
<section id="hero-animated" class="hero-animated d-flex align-items-center">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
      <img src="{{ asset('page/assets/img/hero-carousel/hero-carousel-3.jpg') }}" class="img-fluid animated">
      <h2>Selamat Datang Di <span>SiManage</span></h2>
      <p>Mudahkan Administrasi Usahamu hanya di SiManage</p>
    </div>
  </section>

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container">

        <div class="row gy-4">
            @if (auth()->check())
            @php $admin = auth()->user()->id_role @endphp
            @if ($admin == 1)
                <script>
                    window.location.href = '{{ url('/admin') }}';
                </script>
            @endif
            <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="200">
                <div class="service-item position-relative">
                  <div class="icon"><i class="bi bi-book"></i></div>
                  <h4><a href="{{ url('/absent') }}" class="stretched-link">Absen</a></h4>
                  <p>Lakukan Absen Dengan Mudah</p>
                </div>
              </div><!-- End Service Item -->

              <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="400">
                <div class="service-item position-relative">
                  <div class="icon"><i class="bi bi-book-half"></i></div>
                  <h4><a href="{{ url('/data_absensi') }}" class="stretched-link">Riwayat Absensi</a></h4>
                  <p>Cek Riwayat Absen</p>
                </div>
              </div><!-- End Service Item -->

              <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="600">
                <div class="service-item position-relative">
                  <div class="icon"><i class="bi bi-cash-coin"></i></div>
                  <h4><a href="{{ url('/riwayat_gaji') }}" class="stretched-link">Riwayat Gaji</a></h4>
                  <p>Control Riwayat Gaji</p>
                </div>
              </div>

            @else
            <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out">
                <div class="service-item position-relative">
                  <div class="icon"><i class="bi bi-clipboard-data-fill"></i></div>
                  <h4><a href="{{ url('/admin') }}" class="stretched-link">Administrasi Usaha</a></h4>
                  <p>Atur administrasi usaha</p>
                </div>
              </div><!-- End Service Item -->

              <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="200">
                <div class="service-item position-relative">
                  <div class="icon"><i class="bi bi-book"></i></div>
                  <h4><a href="{{ url('/absent') }}" class="stretched-link">Absen</a></h4>
                  <p>Lakukan Absen Dengan Mudah</p>
                </div>
              </div><!-- End Service Item -->

              <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="400">
                <div class="service-item position-relative">
                  <div class="icon"><i class="bi bi-book-half"></i></div>
                  <h4><a href="{{ url('/data_absensi') }}" class="stretched-link">Riwayat Absensi</a></h4>
                  <p>Cek Riwayat Absen</p>
                </div>
              </div><!-- End Service Item -->

              <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="600">
                <div class="service-item position-relative">
                  <div class="icon"><i class="bi bi-cash-coin"></i></div>
                  <h4><a href="{{ url('/riwayat_gaji') }}" class="stretched-link">Riwayat Gaji</a></h4>
                  <p>Control Riwayat Gaji</p>
                </div>
              </div><!-- End Service Item -->
            @endif

        </div>

      </div>
    </section><!-- End Featured Services Section -->

    <!-- ======= Call To Action Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-out">

        <div class="row g-5">

          <div class="col-lg-8 col-md-6 content d-flex flex-column justify-content-center order-last order-md-first">
            <h3>SiManage <em>Hadir,</em> Masalah Administrasi Usaha menjadi teratasi</h3>
            <p> Jika anda memiliki masalah terkait dengan pengelolaan adminitrasi usaha anda, konsultasikan langsung dengan klik call di bawah ini, dan selesaikan masalah anda bersama SiManage</p>
            <a class="cta-btn align-self-start" href="https://wa.me/082322345597">Call To Action</a>
          </div>

          <div class="col-lg-4 col-md-6 order-first order-md-last d-flex align-items-center">
            <div class="img">
              <img src="{{ asset('page/assets/img/cta.jpg') }}" alt="" class="img-fluid">
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Call To Action Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content px-xl-5">
              <h3>Pertanyaan Tentang <strong>SiManage</strong></h3>
              <p>
                Beberapa pertanyaan yang sering ditanyakan terkait dengan SiManage
              </p>
            </div>

            <div class="accordion accordion-flush px-xl-5" id="faqlist">

              <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    <i class="bi bi-question-circle question-icon"></i>
                    Apa Itu SiManage?
                  </button>
                </h3>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    SiManage adalah Aplikasi Berbasis Website yang dibuat untuk membantu pelaku usaha khususnya UMKM untuk mengelola administrasi usaha
                  </div>
                </div>
              </div><!-- # Faq item-->

              <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                    <i class="bi bi-question-circle question-icon"></i>
                    Fitur Apa Saja Yang Ada Di Dalam SiManage?
                  </button>
                </h3>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Fitur yang terdapat di dalam SiManage adalah pengelolaan data karyawan, penggajian karyawan, pengelolaan keuangan usaha, absen karyawan
                  </div>
                </div>
              </div><!-- # Faq item-->

              <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                    <i class="bi bi-question-circle question-icon"></i>
                    Apakah Data Informasi Usaha dan Karyawan Aman?
                  </button>
                </h3>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Sangat aman, karena semua data-data telah di enkripsi sehingga aman dari pencurian data
                  </div>
                </div>
              </div><!-- # Faq item-->

              <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                    <i class="bi bi-question-circle question-icon"></i>
                    Apakah Aplikasi Ini bisa digunakan untuk semua jenis usaha?
                  </button>
                </h3>
                <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    <i class="bi bi-question-circle question-icon"></i>
                    Bisa, aplikasi SiManage bisa digunakan untuk semua jenis usaha
                  </div>
                </div>
              </div><!-- # Faq item-->


            </div>

          </div>

          <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("page/assets/img/faq.jpg");'>&nbsp;</div>
        </div>

      </div>
    </section><!-- End F.A.Q Section -->

  </main><!-- End #main -->
@endsection
