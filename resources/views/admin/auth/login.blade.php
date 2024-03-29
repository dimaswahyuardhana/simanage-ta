<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link src="{{ asset('landing/assets/img/logo-simanage.png') }}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xrhyvPoiRqjZlnDSGc1C5J/uQDId6ZIcjPBE6M6jW9vSlazZzZxeOJl3/9CJ8bQNGTpeviF9rkL7LQN5tFwN2g==" crossorigin="anonymous" />


    <!-- Vendor CSS Files -->
    <link href="{{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('page/assets/img/logo.png') }}" alt="" style="width: 7em">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                    <p class="text-center small">Masukkan Email dan Password Anda</p>
                  </div>

                  <form action="{{ route('login') }}" method="POST"  class="row g-3 needs-validation" >
                    @csrf

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required>
                      @error('email')
                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                      <div class="d-flex justify-content-end">
                        <div toggle="#password"  class="field-icon toggle-password" style="margin-top: -2rem; margin-right: 5px">
                            <i class="bi bi-eye" id="toggle-password"></i>
                            <i class="bi bi-eye-slash d-none" id="mata-tutup"></i>
                        </div>
                      </div>
                      @error('password')
                        <div id="passwordHelp" class="form-text">{{ $message }}</div>
                       @enderror
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Tidak punya akun? Buat akun <a href="{{ url('/register/admin') }}"> Admin</a> or <a href="{{ url('/register/Employee') }}"> Karyawan</a></p>
                    </div>
                  </form>

                </div>
              </div>


            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('template/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('template/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('template/assets/js/main.js') }}"></script>

<script>
    const togglePassword = document.querySelector(".toggle-password");
    const mataTutup = document.querySelector("#mata-tutup");

    togglePassword.addEventListener("click", function (e) {
        var input = document.querySelector("#password");

        if (input.type === "password") {
            input.type = "text";
            mataTutup.classList.remove("d-none");
            mataTutup.classList.add("d-block");
            togglePassword.querySelector("#toggle-password").classList.remove("bi-eye");
            // togglePassword.querySelector("#toggle-password").classList.add("bi-eye-slash");
        } else {
            input.type = "password";
            mataTutup.classList.remove("d-block");
            mataTutup.classList.add("d-none");
            togglePassword.querySelector("#toggle-password").classList.remove("bi-eye-slash");
            togglePassword.querySelector("#toggle-password").classList.add("bi-eye");
        }
    });
</script>


</body>

</html>
