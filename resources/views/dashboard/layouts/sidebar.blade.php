<div class="sidebar border col-md-3 col-lg-2 p-0" style="background-color: white;">
    <div class="offcanvas-md offcanvas-end" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel" style="background-color: #e3f2fd;">
        <div class="offcanvas-header" style="background-color: #bbdefb;">
            <h5 class="offcanvas-title" id="sidebarMenuLabel" style="color: #0d47a1; font-family: 'Poppins', sans-serif;">
                Praktik Bidan
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">

                <!-- Back to Blog -->
                                
                @canany(['admin', 'pegawai'])
                <!-- Admin Section -->
                <h6 class="sidebar-heading d-flex justify-content-start align-items-center px-3 my-3 text-uppercase" style="color: #0d47a1;">
                    <i class="bi bi-person-vcard" style="color: #1e88e5;"></i>
                    <span class="ms-2 fw-bold" style="font-family: 'nunito', sans-serif; font-weight:600;">Admin</span>
                </h6>
                <hr class="my-3" style="border-color: #bbdefb;">

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-dashboard') active @endif" href="{{ route('dashboard.bidan') }}" style="color: #1e88e5;">
                        <i class="bi bi-display"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-users') active @endif" href="{{ route('admin.users.index') }}" style="color: #1e88e5;">
                        <i class="bi bi-person-circle"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Pengguna</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active == 'layanan') active @endif" href="{{ route('layanan.index') }}" style="color: #1e88e5;">
                        <i class="bi bi-file-earmark-text"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Layanan</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-janjitemu') active @endif" href="{{ route('janjitemu.index') }}" style="color: #1e88e5;">
                        <i class="bi bi-chat-left-text"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Janji Temu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-transaksi') active @endif" href="{{ route('transaksi.index') }}" style="color: #1e88e5;">
                        <i class="bi bi-chat-left-text"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Transaksi</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-kunjungan') active @endif" href="{{ route('kunjungan.index') }}" style="color: #1e88e5;">
                        <i class="bi bi-chat-left-text"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Kunjungan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-ulasan') active @endif" href="{{ route('admin.ulasan.index') }}" style="color: #1e88e5;">
                        <i class="bi bi-chat-left-text"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Ulasan</span>
                    </a>
                </li>

                @can('admin')
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-penggajian') active @endif" href="{{ route('admin.penggajian.index') }}" style="color: #1e88e5;">
                        <i class="bi bi-chat-left-text"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Penggajian</span>
                    </a>
                </li>
                @endcan


                <hr class="my-3" style="border-color: #bbdefb;">
                @endcanany

                @can('user')
                <!-- User Section -->
                <h6 class="sidebar-heading d-flex justify-content-start align-items-center px-3 my-3 text-uppercase" style="font-family: 'Nunito', sans-serif; font-weight: 600; color: #0d47a1;">
                    <i class="bi bi-person" style="color: #1e88e5;"></i>
                    <span class="ms-2 fw-bold" style="font-family: 'nunito', sans-serif;">Pasien</span>
                </h6>
                <hr class="my-3" style="border-color: #bbdefb;">

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'dashboard') active @endif" href="{{ route('dashboard') }}" style="color: #1e88e5;">
                        <i class="bi bi-house"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Beranda</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active == 'janji') active @endif" href="{{ route('janji.temu', ['idPasien' => auth()->id()]) }}" style="color: #1e88e5;">
                        <i class="bi bi-calendar-event"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Janji Temu</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active == 'riwayat') active @endif" href="{{ route('riwayat.kunjungan', ['idPasien' => auth()->id()]) }}" style="color: #1e88e5;">
                        <i class="bi bi-clock-history"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Riwayat Kunjungan</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active == 'layanan') active @endif" href="{{ route('layanan.index') }}" style="color: #1e88e5;">
                        <i class="bi bi-heart"></i>
                        <span style="font-family: 'Poppins', sans-serif;">Layanan</span>
                    </a>
                </li>
                @endcan

                <!-- Logout -->
                <hr class="my-3" style="border-color: #bbdefb;">
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="nav-link d-flex align-items-center gap-2" style="color: #0d47a1;">
                            @csrf
                            <i class="bi bi-box-arrow-left"></i>
                            <button class="dropdown-item fw-bold" type="submit" style="border: none; background: none; color: inherit;">Keluar</button>
                        </form>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
</div>
