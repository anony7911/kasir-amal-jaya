<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title') @yield('title') | @endif
        {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @livewireStyles
    <link rel="shortcut icon" href="{{ url('/') }}/assets/img/AMAL_JAYA_KECIL.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css">

</head>

<body>
    <div class="main-wrapper">

        <div class="header">

            <div class="header-left">
                <a href="/home" class="logo">
                    <img src="{{ url('/') }}/assets/img/AMAL_JAYA_BESAR.png" alt="Logo" width="25" height="25">
                </a>
                <a href="/home" class="logo logo-small">
                    <img src="{{ url('/') }}/assets/img/AMAL_JAYA_KECIL.png" alt="Logo" width="30" height="30">
                </a>
            </div>
            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="nav user-menu">

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{ url('/') }}/assets/img/profiles/avatar-01.jpg" width="31" alt="user">
                            <div class="user-text">
                                <h6> {{ Auth::check() ? Auth::user()->name : 'Guest' }} </h6>
                                <p class="text-muted mb-0">{{ Auth::check() ? Auth::user()->role : 'Guest' }}</p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="{{ url('/') }}/assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>
                                    {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                                </h6>
                                <p class="text-muted mb-0">
                                    {{ Auth::check() ? Auth::user()->role : 'Guest' }}
                                </p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    @auth()
                    <ul class="navbar-nav mr-auto">
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>
                        <!--Nav Bar Hooks - Do not delete!!-->
                        @if(Auth::user()->role == 'admin')
                        <li class="nav-item @if(request()->is('home')) active @endif">
                            <a href="{{ url('/home') }}" class="nav-link"><i class="feather-grid"></i> Home</a>
                        </li>
                        <li class="nav-item @if(request()->is('users')) active @endif">
                            <a href="{{ url('/users') }}" class="nav-link"><i class="feather-users"></i> User</a>
                        </li>
                        <li class="nav-item @if(request()->is('tokos')) active @endif">
                            <a href="{{ url('/tokos') }}" class="nav-link"><i class="feather-home"></i> Toko/Gudang</a>
                        </li>
                        <li class="nav-item @if(request()->is('pegawais')) active @endif">
                            <a href="{{ url('/pegawais') }}" class="nav-link"><i class="feather-users"></i> Pegawai</a>
                        </li>
                        <li class="nav-item @if(request()->is('suppliers')) active @endif">
                            <a href="{{ url('/suppliers') }}" class="nav-link"><i class="feather-user-check"></i> Supplier</a>
                        </li>
                        <li class="nav-item @if(request()->is('barangs')) active @endif">
                            <a href="{{ url('/barangs') }}" class="nav-link"><i class="feather-folder-plus"></i> Barang</a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'supplier')
                        <li class="nav-item @if(request()->is('barangs/barang-supplier')) active @endif">
                            <a href="{{ url('/barangs/barang-supplier') }}" class="nav-link"><i class="feather-folder-plus"></i> Harga Barang</a>
                        </li>
                        @endif
                        <li class="nav-item @if(request()->is('pembelians')) active @endif">
                            <a href="{{ url('/pembelians') }}" class="nav-link"><i class="feather-shopping-bag"></i>
                                @if(Auth::user()->role == 'supplier')
                                Pesanan
                                @else
                                Pembelian
                                @endif
                            </a>
                        </li>
                        @if(Auth::user()->role !== 'supplier')
                        <li class="nav-item @if(request()->is('penjualans')) active @endif">
                            <a href="{{ url('/penjualans') }}" class="nav-link"><i class="feather-shopping-cart"></i> Penjualan</a>
                        </li>
                        <li class="nav-item @if(request()->is('laporan')) active @endif">
                            <a href="{{ url('/laporan') }}" class="nav-link"><i class="feather-printer"></i> Laporan</a>
                        </li>
                        @endif
                    </ul>
                    @endauth()
                </div>
            </div>
        </div>


        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('content')

                <footer>
                    <p>Copyright © {{
                        date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                </footer>
            </div>
        </div>
    </div>
    @livewireScripts
    <script type="module">
        const addModal = new bootstrap.Modal('#createDataModal');
        const editModal = new bootstrap.Modal('#updateDataModal');
        window.addEventListener('closeModal', () => {
            addModal.hide();
            editModal.hide();
        })
    </script>
    <script src="{{ url('/') }}/assets/js/jquery-3.6.0.min.js"></script>
    <script src="{{ url('/') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/assets/js/feather.min.js"></script>
    <script src="{{ url('/') }}/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ url('/') }}/assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="{{ url('/') }}/assets/plugins/apexchart/chart-data.js"></script>
    <script src="{{ url('/') }}/assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $("#toggle_btn").click(function() {
                $(".sidebar").toggleClass("active");
                $(".main-wrapper").toggleClass("active");
                $(".sidebar-inner").toggleClass("active");
            });
        });

    </script>
</body>

</html>

