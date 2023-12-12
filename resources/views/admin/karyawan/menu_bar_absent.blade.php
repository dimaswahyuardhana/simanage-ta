<div class="card pe-0 mb-2 me-0" style="display: inline-block">
    <nav class="navbar navbar-expand-lg bg-body-tertiary p-0 m-0">
        <div class="container-fluid">
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link collapsed me-3"
                        href="{{ route('hadir', ['id' => $dataKaryawan[0]->id]) }}">Hadir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed me-3"
                        href="{{ route('izin', ['id' => $dataKaryawan[0]->id]) }}">Izin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed me-3" href="{{ route('sakit', ['id' => $dataKaryawan[0]->id]) }}">Sakit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed me-3"
                        href="{{ route('alpha', ['id' => $dataKaryawan[0]->id]) }}">Alpha</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
