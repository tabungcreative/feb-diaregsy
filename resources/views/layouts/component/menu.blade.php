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
        <span>Pendaftaran SPL</span></a>
</li>
