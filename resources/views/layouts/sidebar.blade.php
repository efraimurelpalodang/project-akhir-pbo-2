<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MatStock<sup>nice</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
        <a wire:navigate class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a wire:navigate class="nav-link" href="/pembeli">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Data Pembeli</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#salesOrder"
            aria-expanded="true" aria-controls="salesOrder">
            <i class="fas fa-fw fa-cog"></i>
            <span>Sales Order</span>
        </a>
        <div id="salesOrder" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="collapse-inner rounded">
                <a wire:navigate class="collapse-item text-white" href="/salesOrder">Daftar Sales Order</a>
                <a wire:navigate class="collapse-item text-white" href="/SOMasuk">Sales Order Masuk</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#suratJalan"
            aria-expanded="true" aria-controls="suratJalan">
            <i class="fas fa-fw fa-cog"></i>
            <span>Surat Jalan</span>
        </a>
        <div id="suratJalan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="collapse-inner rounded">
                <a wire:navigate class="collapse-item text-white" href="/surat">So Siap Diantar</a>
                <a wire:navigate class="collapse-item text-white" href="/listSJ">Daftar Surat Jalan</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true"
            aria-controls="laporan">
            <i class="fas fa-fw fa-cog"></i>
            <span>Cetak Laporan</span>
        </a>
        <div id="laporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="collapse-inner rounded">
                <a class="collapse-item text-white" href="/cetak/penjualan" target="blank">Laporan Penjualan</a>
                <a class="collapse-item text-white" href="/cetak/stok" target="blank">Laporan Stok</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>
    <li class="nav-item">
        <a wire:navigate class="nav-link" href="/barang">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Data Barang</span></a>
    </li>
    <li class="nav-item">
        <a wire:navigate class="nav-link" href="/satuan">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Data Satuan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed {{ Route::is('superadmin.*') ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#managementPengguna"
            aria-expanded="true" aria-controls="managementPengguna">
            <i class="fas fa-fw fa-folder"></i>
            <span>Management Pengguna</span>
        </a>
        <div id="managementPengguna" class="collapse {{ request()->is('superadmin/*') ? 'show' : '' }}" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a wire:navigate class="collapse-item text-white {{ Route::is('superadmin.user.*') ? 'active' : '' }}" href="/superadmin/user">Data Pengguna</a>
                <a wire:navigate class="collapse-item text-white" href="/superadmin/peran">Data Peran</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->
