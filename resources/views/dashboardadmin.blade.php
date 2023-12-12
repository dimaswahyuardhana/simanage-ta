@extends('admin.layout.index')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
      <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Karyawan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $employee }}</div>
                        </div>
                        <div class="col-auto">
                            <li class="fas fa-calendar fa-2x text-gray-300">
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jabatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $job }}</div>
                        </div>
                        <div class="col-auto">
                            <li class="fas fa-calendar fa-2x text-gray-300">
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
