<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading text-white">
    Pendaftaran
</div>

<li class="nav-item {{ Route::is('admin.spl.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.spl.index') }}">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Pendaftaran Studi Ekskursi</span></a>
</li>

<li class="nav-item {{ Route::is('admin.magang.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.magang.index') }}">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Pendaftaran Magang</span></a>
</li>

<li class="nav-item {{ Route::is('admin.bimbinganSkripsi.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.bimbinganSkripsi.index') }}">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Pendaftaran Bimbingan Skripsi</span></a>
</li>

<li class="nav-item {{ Route::is('admin.sempro.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.sempro.index') }}">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Pendaftaran Seminar Proposal</span></a>
</li>

<li class="nav-item {{ Route::is('admin.kompre.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.kompre.index') }}">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Pendaftaran Ujian Komprehensif</span></a>
</li>

<li class="nav-item {{ Route::is('admin.mengulang.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.mengulang.index') }}">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Pendaftaran Mengulang</span></a>
</li>

