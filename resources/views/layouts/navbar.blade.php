<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <livewire:components.alerts-dropdown dropdownId="alertsDropdown" icon="fas fa-bell" counter="3+" title="Alerts Center"
            footerText="Show All Alerts" :items="[
                [
                    'icon' => 'fas fa-file-alt',
                    'bg' => 'bg-primary',
                    'text' => 'A new monthly report is ready to download!',
                    'time' => 'Dec 12, 2019',
                    'bold' => true,
                ],
                [
                    'icon' => 'fas fa-donate',
                    'bg' => 'bg-success',
                    'text' => '$290.29 has been deposited into your account!',
                    'time' => 'Dec 7, 2019',
                ],
                [
                    'icon' => 'fas fa-exclamation-triangle',
                    'bg' => 'bg-warning',
                    'text' => 'Spending Alert: unusually high spending',
                    'time' => 'Dec 2, 2019',
                ],
            ]" />

        <livewire:components.alerts-dropdown dropdownId="messagesDropdown" icon="fas fa-envelope" counter="7"
            title="Message Center" footerText="Read More Messages" :items="[
                [
                    'img' => asset('assets/img/undraw_profile_1.svg'),
                    'status' => 'bg-success',
                    'text' => 'Hi there! I need help...',
                    'time' => 'Emily · 58m',
                    'bold' => true,
                ],
                [
                    'img' => asset('assets/img/undraw_profile_2.svg'),
                    'text' => 'I have the photos you ordered...',
                    'time' => 'Jae · 1d',
                ],
                [
                    'img' => asset('assets/img/undraw_profile_3.svg'),
                    'status' => 'bg-warning',
                    'text' => 'Last month report looks great!',
                    'time' => 'Morgan · 2d',
                ],
            ]" />

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                <img class="img-profile rounded-circle" src="{{ asset('assets/img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<livewire:components.modal id="logoutModal" body="Apakah anda yakin ingin keluar?" btnLeft="Batal" btnRight="Keluar"
    title="Keluar" />
<!-- End of Topbar -->

<!-- Scroll to Top Button-->
{{-- <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a> --}}
