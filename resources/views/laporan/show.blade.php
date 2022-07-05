@extends('layouts.app')

@section('title', __('Detail Laporan'))

@push('css')
    <style>
        table td,
        table td * {
            vertical-align: top;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{ __('Laporan') }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('laporan.index') }}">{{ __('Laporan') }}</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ __('Detail') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="blog-detail-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <img src="{{ asset('') }}public/dokumentasi/{{ $laporan->laporanDokumentasi->dokumen }}"
                                class="img-fluid card-img-top" alt="Dokumentasi Pic" style="max-height: 75vh;" />
                            <div class="card-body">
                                <h4 class="card-title">
                                    {{ $laporan->jenisKegiatan ? $laporan->jenisKegiatan->nama_jenis_kegiatan : '' }}
                                </h4>
                                <div class="d-flex mb-2">
                                    <div class="author-info">
                                        <small class="text-body">{{ $laporan->user ? $laporan->user->name : '' }}</small>
                                        <span class="text-muted ms-50 me-25">|</span>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($laporan->tgl_kegiatan)->isoFormat('D MMMM Y') }},
                                            {{ \Carbon\Carbon::parse($laporan->jam_pelaporan)->isoFormat('HH:MM') }}
                                        </small>
                                    </div>
                                </div>
                                <h4 class="mb-75">{{ __('Keterangan') }}:</h4>
                                <p class="card-text mb-2">
                                    {{ $laporan->keterangan_lainnya }}
                                </p>
                                <h4 class="mb-75">{{ __('Jumlah Personil Yang Terlibat') }}:</h4>
                                <table class="p-0 mb-2">
                                    <tbody>
                                        <tr>
                                            <td>{{ __('Polisi') }}</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $laporan->polisi }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('TNI') }}</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $laporan->tni }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Pol PP Kab/Kota') }}</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $laporan->pol_pp }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Perangkat Daerah Lainnya') }}</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $laporan->perangkat_daerah_lainnya }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h4 class="mb-75">{{ __('Lokasi') }}:</h4>
                                <input type="hidden" id="latitude" value="{{ $laporan->latitude }}">
                                <input type="hidden" id="longitude" value="{{ $laporan->longitude }}">
                                <div id="map" style=" height: 50vh;width: 100%;margin-top: 10px;">
                                </div>
                                <table class="p-0 mb-2 mt-1">
                                    <tbody>
                                        <tr>
                                            <td>{{ __('Alamat Lengkap') }}</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $laporan->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Lokasi') }}</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $laporan->lokasi }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Latitude') }}</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $laporan->latitude }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Longitude') }}</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{ $laporan->longitude }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if ($laporan->laporanPelanggaran)
                                    <h4 class="mb-75">{{ __('Pelanggaran') }}:</h4>
                                    <table class="p-0 mb-2">
                                        <tbody>
                                            <tr>
                                                <td>{{ __('Jenis Pelanggaran') }}</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>
                                                    {{ $laporan->laporanPelanggaran ? ($laporan->laporanPelanggaran->jenisPelanggaran ? $laporan->laporanPelanggaran->jenisPelanggaran->nama_jenis_pelanggaran : '') : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Sangsi') }}</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>
                                                    {{ $laporan->laporanPelanggaran ? ($laporan->laporanPelanggaran->sangsi ? $laporan->laporanPelanggaran->sangsi->nama_sangsi : '') : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Detail') }}</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>
                                                    {{ $laporan->laporanPelanggaran ? $laporan->laporanPelanggaran->detail : '' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                                @if ($laporan->laporanDokumentasi)
                                    <h4 class="mb-75">{{ __('Dokumentasi') }}:</h4>
                                    <table class="p-0 mb-2">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    @if ($laporan->laporanDokumentasi->dokumen)
                                                        <a href="{{ asset('') }}public/dokumentasi/{{ $laporan->laporanDokumentasi->dokumen }}"
                                                            target="_blank">
                                                            <img src="{{ asset('') }}public/dokumentasi/{{ $laporan->laporanDokumentasi->dokumen }}"
                                                                alt="dokumen" class="rounded me-2 mb-1 mb-md-0"
                                                                width="170" height="110">
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                                <hr class="my-2" />
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center me-1">
                                            <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-warning">
                                                {{ __('Edit') }}
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">
                                                {{ __('Kembali') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('') }}public/assets/js/laporan/show/maps.js"></script>
@endpush
