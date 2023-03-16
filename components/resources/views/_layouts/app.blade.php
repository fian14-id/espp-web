<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/assets/" data-template="pembayaran-spp" data-type="petugas">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') | {{ env('APP_NAME') }}</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    {{-- <link rel="stylesheet" href="{{ url('/assets/vendor/fonts/fontawesome.css') }}" /> --}}
    <link rel="stylesheet" href="{{ url('/assets/vendor/fonts/tabler-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('/assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ url('/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ url('/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    @yield('cssv')

    <!-- Page CSS -->
    @yield('css')

    <!-- Helpers -->
    <script src="{{ url('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ url('/assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ url('/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="/assets/img/logo.png" alt="{{ env('APP_NAME') }}" width="30">
              </span>
              <span class="app-brand-text demo menu-text fw-bold">{{ env('APP_NAME') }}</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            @auth('petugas')
            @if (auth()->guard('petugas')->user()->level == 'petugas')
            <li class="menu-item">
              <a href="{{ route('petugas.dash') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-dashboard"></i>
                <div data-i18n="Dasbor">Dasbor</div>
              </a>
            </li>
            @endauth
            @if (auth()->guard('petugas')->user()->level == 'admin')
            <li class="menu-item">
              <a href="{{ route('admin.dash') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-dashboard"></i>
                <div data-i18n="Dasbor">Dasbor</div>
              </a>
            </li>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Halaman</span>
            </li>
            <li class="menu-item">
              <a href="{{ route('petugas.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div data-i18n="Petugas">Petugas</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('siswa.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-id"></i>
                <div data-i18n="Siswa">Siswa</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('kelas.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-school"></i>
                <div data-i18n="Kelas">Kelas</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('spp.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-description"></i>
                <div data-i18n="SPP">SPP</div>
              </a>
            </li>
            @endif

            @if (auth()->guard('petugas')->user()->level == 'admin' || auth()->guard('petugas')->user()->level == 'petugas')
            <li class="menu-item">
              <a href="{{ route('pby.entri') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-cash"></i>
                <div data-i18n="Pembayaran">Pembayaran</div>
              </a>
            </li>
            @endif
            @endauth
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                  <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                    <i class="ti ti-search ti-md me-2"></i>
                    <span class="d-none d-md-inline-block text-muted">Cari siswa (Ctrl+/)</span>
                  </a>
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Style Switcher -->
                <li class="nav-item me-2 me-xl-0">
                  <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class="ti ti-md"></i>
                  </a>
                </li>
                <!--/ Style Switcher -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      @auth('petugas')
                      <img src="https://ui-avatars.com/api/?background=random&name={{ auth()->guard('petugas')->user()->nama_petugas }}" alt class="h-auto rounded-circle" />
                      @endauth
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              @auth('petugas')
                              <img src="https://ui-avatars.com/api/?background=random&name={{ auth()->guard('petugas')->user()->nama_petugas }}" alt class="h-auto rounded-circle" />
                              @endauth
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            @auth('petugas')
                            <span class="fw-semibold d-block">{{ auth()->guard('petugas')->user()->nama_petugas }}</span>
                            <small class="text-muted">{{ auth()->guard('petugas')->user()->level }}</small>
                            @endauth
                          </div>
                        </div>
                      </a>
                    </li>
                    {{-- <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="ti ti-settings me-2 ti-sm"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li> --}}
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="ti ti-logout me-2 ti-sm"></i>
                        <span class="align-middle">Keluar</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search..." />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Extended UI /</span> SweetAlert2</h4> -->

              @yield('content')
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                  <div>© <script>document.write(new Date().getFullYear());</script>, credit by <span id="credit-link" class="fw-semibold text-primary" role="button">click me</span>
                  </div>
                  <div>
                    <a href="https://apps.jagocode.my.id" class="footer-link me-4" target="_blank">Project</a>
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ url('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ url('/assets/vendor/libs/hammer/hammer.js') }}"></script>
    {{-- <script src="{{ url('/assets/vendor/libs/i18n/i18n.js') }}"></script> --}}
    <script src="{{ url('/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ url('/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    @yield('jsv')

    <!-- Main JS -->
    <script src="{{ url('/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    @yield('js')
  </body>
</html>
