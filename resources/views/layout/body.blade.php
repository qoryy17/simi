@include('layout.header')
<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
        <!-- Note : element can be adding in here -->
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('resources/vendors/images/img.jpg') }}" alt="" />
                                    <h3>John Doe</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle mt-2" href="#" role="button" data-toggle="dropdown">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href=""><i class="dw dw-user1"></i> Profile</a>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @method('POST')
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="dw dw-logout"></i> Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="right-sidebar">
    <div class="sidebar-title">
        <h3 class="weight-600 font-16 text-blue">
            Layout Settings
            <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
        </h3>
        <div class="close-sidebar" data-toggle="right-sidebar-close">
            <i class="icon-copy ion-close-round"></i>
        </div>
    </div>
    <div class="right-sidebar-body customscroll">
        <div class="right-sidebar-body-content">
            <h4 class="weight-600 font-18 pb-10">Header Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
            </div>

            <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
            </div>

            <div class="reset-options pt-30 text-center">
                <button class="btn btn-danger" id="reset-settings">
                    Reset Settings
                </button>
            </div>
        </div>
    </div>
</div>

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('dashboard.home') }}">
            <img src="{{ asset('resources/images/SIMI Logo - Original with Transparent Background.svg') }}"
                alt="" class="dark-logo" />
            <img src="{{ asset('resources/images/SIMI Logo - White with Transparent Background.svg') }}" alt=""
                class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('dashboard.home') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-house "></span><span class="mtext">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.pengguna') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-person "></span><span class="mtext">Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.guru-pegawai') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-people "></span><span class="mtext">Guru & Pegawai</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.jabatan') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-person-plus "></span><span class="mtext">Jabatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.ruangan') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-building "></span><span class="mtext">Ruangan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.peminjaman') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-folder "></span><span class="mtext">Peminjaman</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-stack"></span><span class="mtext">Kelola Barang</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="javascript:;">Pendataan</a></li>
                        <li><a href="javascript:;">Distribusi</a></li>
                        <li><a href="{{ route('dashboard.satuan-barang') }}">Satuan</a></li>
                        <li><a href="{{ route('dashboard.kondisi-barang') }}">Kondisi</a></li>
                        <li><a href="javascript:;">Histori</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('dashboard.pengaturan') }}" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-gear "></span><span class="mtext">Pengaturan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>

@if (session()->has('success'))
    <script>
        swal({
            type: 'success',
            title: 'Success...',
            text: "{{ session('success') }}"
        });
    </script>
@elseif (session()->has('error'))
    <script>
        swal({
            type: 'error',
            title: 'Error...',
            text: "{{ session('error') }}"
        });
    </script>
@endif
@yield('content')

@include('layout.footer')
