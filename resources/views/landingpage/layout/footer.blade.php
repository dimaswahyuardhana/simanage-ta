<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>SiManage</h3>
              <p>
                Dimas Wahyu Ardhana <br>
                Jepara, Jawa Tengah, Indonesia<br><br>
                <strong>Phone:</strong> 082322345597<br>
                <strong>Email:</strong> dimasardhana29@gmail.com<br>
              </p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Administrasi Usaha</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Absen</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Data Absen</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Riwayat Gaji</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="footer-legal text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div class="copyright">
            &copy; Copyright <strong><span>SiManage</span></strong>. All Rights Reserved
          </div>
          {{-- <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div> --}}
        </div>

        <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
          <a href="https://twitter.com/dimasbjr10" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="https://www.instagram.com/dimas.bjr/" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://www.linkedin.com/in/dimas-ardhana-45253b245/" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>

      </div>
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('page/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('page/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('page/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('page/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('page/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('page/assets/js/main.js') }}"></script>


</body>

</html>

{{-- jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

{{-- Notification Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    @if (Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
    @endif
</script>

@if (session('error'))
    <script>
        $(document).ready(function() {
            toastr.error('{{ session('error') }}');
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $('#submitBtn').click(function(e) {
            e.preventDefault(); // Mencegah aksi default tombol submit

            // Kirim permintaan AJAX ke server
            $.ajax({
                type: 'PUT',
                url: '/absen', // Ganti dengan URL endpoint yang sesuai
                data: {
                    status: $('input[name="status"]:checked').val(),
                    keterangan: $('textarea[name="keterangan"]').val()
                },
                success: function(response) {
                    if (response.error) {
                        toastr.error(response.error);
                    } else {
                        toastr.success(response.success);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(
                        error); // Log error jika terjadi kesalahan saat permintaan AJAX
                }
            });
        });
    });
</script>

</body>

</html>
