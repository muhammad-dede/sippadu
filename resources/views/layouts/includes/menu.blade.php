<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('home') }}">
                    <span class="brand-logo">
                        <img src="{{ asset('') }}public/logo.png" alt="" class="w-75">
                    </span>
                    <h2 class="brand-text">
                        {{ config('app.name') }}
                    </h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="mt-2 nav-item {{ Request::is('/') || Request::is('home') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('home') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="{{ __('Beranda') }}">
                        {{ __('Beranda') }}
                    </span>
                    {{-- <span class="badge badge-light-warning rounded-pill ms-auto me-1">2</span> --}}
                </a>
            </li>
            @role('admin')
                {{-- Divider --}}
                <li class=" navigation-header">
                    <span data-i18n="{{ __('Manajemen Data') }}">{{ __('Manajemen Data') }}</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="layout"></i>
                        <span class="menu-title text-truncate" data-i18n="{{ __('Master Data') }}">
                            {{ __('Master Data') }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <li
                            class="{{ Request::is('bidang') || Request::is('bidang/*/edit') || Request::is('bidang/create') ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('bidang.index') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="{{ __('Bidang') }}">
                                    {{ __('Bidang') }}
                                </span>
                            </a>
                        </li>
                        <li
                            class="{{ Request::is('jenis-kegiatan') || Request::is('jenis-kegiatan/*/edit') || Request::is('jenis-kegiatan/create') ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('jenis-kegiatan.index') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="{{ __('Jenis Kegiatan') }}">
                                    {{ __('Jenis Kegiatan') }}
                                </span>
                            </a>
                        </li>
                        <li
                            class="{{ Request::is('jenis-pelanggaran') || Request::is('jenis-pelanggaran/*/edit') || Request::is('jenis-pelanggaran/create') ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('jenis-pelanggaran.index') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="{{ __('Jenis Pelanggaran') }}">
                                    {{ __('Jenis Pelanggaran') }}
                                </span>
                            </a>
                        </li>
                        <li
                            class="{{ Request::is('sangsi') || Request::is('sangsi/*/edit') || Request::is('sangsi/create') ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('sangsi.index') }}">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="{{ __('Sangsi') }}">
                                    {{ __('Sangsi') }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class=" nav-item {{ Request::is('user') || Request::is('user/*/edit') || Request::is('user/create') ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('user.index') }}">
                        <i data-feather='users'></i>
                        <span class="menu-title text-truncate" data-i18n="{{ __('User') }}">
                            {{ __('User') }}
                        </span>
                    </a>
                </li>
            @endrole
            {{-- Divider --}}
            <li class=" navigation-header">
                <span data-i18n="{{ __('Laporan') }}">{{ __('Laporan') }}</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item {{ Request::is('laporan/create') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('laporan.create') }}">
                    <i data-feather='file-plus'></i>
                    <span class="menu-title text-truncate" data-i18n="{{ __('Buat Laporan') }}">
                        {{ __('Buat Laporan') }}
                    </span>
                </a>
            </li>
            <li
                class=" nav-item {{ Request::is('laporan') || Request::is('laporan/*/edit') || Request::is('laporan/*/show') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('laporan.index') }}">
                    <i data-feather='book-open'></i>
                    <span class="menu-title text-truncate" data-i18n="{{ __('Data Laporan') }}">
                        {{ __('Data Laporan') }}
                    </span>
                </a>
            </li>
            {{-- Divider --}}
            <li class=" navigation-header">
                <span data-i18n="{{ __('Pengaturan') }}">{{ __('Pengaturan') }}</span>
                <i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item {{ Request::is('akun') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('akun.index') }}">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="{{ __('Akun') }}">
                        {{ __('Akun') }}
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
