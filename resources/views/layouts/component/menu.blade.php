<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="/admin/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ Route::is('admin.tahunAjaran.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.tahunAjaran.index') }}">
        <i class="fa fa-calendar"></i>
        <span>Tahun Ajaran</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading text-white">
    Pendaftaran
</div>

<li class="nav-item {{ Route::is('admin.spl.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.spl.index') }}">
        <i class="fa fa-list-alt"></i>
        <span>Pendaftaran Studi Ekskursi</span></a>
</li>

<li class="nav-item {{ Route::is('admin.magang.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.magang.index') }}">
        <i class="fa fa-window-maximize"></i>
        <span>Pendaftaran Kerja Praktik</span></a>
</li>

<li class="nav-item {{ Route::is('admin.mengulang.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.mengulang.index') }}">
        <i class="fa fa-window-restore"></i>
        <span>Pendaftaran Mengulang</span></a>
</li>

<li class="nav-item {{ Route::is('admin.sempro.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.sempro.index') }}">
        <i class="fa fa-address-card"></i>
        <span>Pendaftaran Seminar Proposal</span></a>
</li>

<li class="nav-item {{ Route::is('admin.bimbinganSkripsi.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.bimbinganSkripsi.index') }}">
        <i class="fa fa-id-card"></i>
        <span>Pendaftaran Bimbingan Tugas Akhir</span></a>
</li>

<li class="nav-item {{ Route::is('admin.kompre.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.kompre.index') }}">
        <i class="fa fa-address-book"></i>
        <span>Pendaftaran Ujian Komprehensif</span></a>
</li>

<li class="nav-item {{ Route::is('admin.ujianAkhir.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.ujianAkhir.index') }}">
        <i class="fa fa-users"></i>
        <span>Pendaftaran Ujian Tugas Akhir</span></a>
</li>
<li class="nav-item {{ Route::is('admin.yudisium.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.yudisium.index') }}">
        <i class="fa fa-graduation-cap"></i>
        <span>Pendaftaran Yudisium</span></a>
</li>

