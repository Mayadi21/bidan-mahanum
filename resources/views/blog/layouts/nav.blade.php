<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm" aria-label="Navbar for Midwife Practice">
    <div class="container-fluid">
        <!-- Logo dan Brand -->
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo.jpeg') }}" alt="Clinic Logo" width="50" class="rounded-circle me-2">
            <a class="navbar-brand fw-bold text-primary" href="#">Bidan Mahanum</a>
        </div>
        <!-- Button Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
            <!-- Header Offcanvas -->
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-primary fw-bold" id="offcanvasNavbar2Label">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <!-- Body Offcanvas -->
            <div class="offcanvas-body">
                <!-- Navigasi -->
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link @if($active === 'home') active fw-bold text-primary @endif" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($active === 'services') active fw-bold text-primary @endif" href="{{route('layanan.index') }}">Services</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link @if($active === 'appointments') active fw-bold text-primary @endif" href="/appointments">Appointments</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link @if($active === 'about') active fw-bold text-primary @endif" href="/about">About Us</a>
                    </li> --}}
                    <!-- Opsi Auth -->
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-primary fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->nama }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ auth()->user()->role == 'admin' ? route('dashboard.bidan') : route('dashboard') }}">Dashboard</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-primary fw-bold ms-2" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
