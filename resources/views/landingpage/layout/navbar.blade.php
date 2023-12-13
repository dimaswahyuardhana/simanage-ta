<!-- ======= Header ======= -->
<header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('page/assets/img/logo.png')}}" alt="">
        <h1>SiManage<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
            @if (auth()->check())
                @php $admin = auth()->user()->id_role @endphp
                @if ($admin == 1)
                    <script>
                        window.location.href = '{{ url('/admin') }}';
                    </script>
                @endif
                <li><a class="nav-link scrollto" href="{{ url('/') }}">Home</a></li>
                <li><a class="nav-link scrollto" href="{{ url('/about') }}">Tentang</a></li>
                <li class="dropdown"><a href="#"><span>Layanan</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                    <li><a href="{{ url('/absent') }}">Absen</a></li>
                    <li><a href="{{ url('/data_absensi') }}">Data Absen</a></li>
                    <li><a href="{{ url('/riwayat_gaji') }}">Riwayat Gaji</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ url('/profile') }}">Profil</a></li>
                <li class="dropdown"><a href="#"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <li>
                                    <button class="btn btn-outline-light">Sign Out</button>
                                </li>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li><a class="nav-link scrollto" href="{{ url('/') }}">Home</a></li>
                <li><a class="nav-link scrollto" href="{{ url('/about') }}">Tentang</a></li>
                <li class="dropdown"><a href="#"><span>Layanan</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                    <li><a href="{{ url('/admin') }}">Administrasi Usaha</a></li>
                    <li><a href="{{ url('/absent') }}">Absen</a></li>
                    <li><a href="{{ url('/data_absensi') }}">Data Absen</a></li>
                    <li><a href="{{ url('/riwayat_gaji') }}">Riwayat Gaji</a></li>
                    </ul>
                </li>

                <a class="btn-getstarted scrollto" href="{{ url('/login') }}" role="a">Sign In</a>

                @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle d-none"></i>
      </nav><!-- .navbar -->


    </div>
  </header><!-- End Header -->
