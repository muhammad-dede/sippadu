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
            <div class="content-header-right text-md-end col-md-3 col-12">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-warning">
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('laporan.print', $laporan->id) }}" class="dt-button create-new btn btn-danger"
                        id="btn-print" target="_blank">
                        <span>
                            {{ __('Print') }}
                        </span>
                    </a>
                    <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">
                        {{ __('Kembali') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="blog-detail-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="p-0 mb-2 table">
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h4 class="mb-75">{{ __('Laporan Kegiatan') }}:</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Judul Kegiatan') }}</td>
                                            <td>:</td>
                                            <td>
                                                <strong>{{ $laporan->judul_kegiatan }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Bidang') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->bidang ? $laporan->bidang->nama_bidang : '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Tanggal') }}</td>
                                            <td>:</td>
                                            <td>{{ \Carbon\Carbon::parse($laporan->tgl_kegiatan)->isoFormat('D MMMM Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Jam') }}</td>
                                            <td>:</td>
                                            <td>{{ \Carbon\Carbon::parse($laporan->jam_pelaporan)->isoFormat('HH:MM') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Jenis Kegiatan') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->jenisKegiatan ? $laporan->jenisKegiatan->nama_jenis_kegiatan : '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Keterangan') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->keterangan_lainnya }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <h4 class="my-75">{{ __('Jumlah Personil Yang Terlibat') }}:</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Pol PP Provinsi') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->pol_pp_prov }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Pol PP Kab/Kota') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->pol_pp_kabkot }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Polisi') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->polisi }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('TNI') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->tni }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Perangkat Daerah Lainnya') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->perangkat_daerah_lainnya }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <h4 class="my-75">{{ __('Lokasi') }}:</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <input type="hidden" id="latitude" value="{{ $laporan->latitude }}">
                                                <input type="hidden" id="longitude" value="{{ $laporan->longitude }}">
                                                <div id="map" style=" height: 50vh;width: 100%;margin-top: 10px;">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Alamat Lengkap') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Lokasi') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->lokasi }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Latitude') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->latitude }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Longitude') }}</td>
                                            <td>:</td>
                                            <td>{{ $laporan->longitude }}</td>
                                        </tr>
                                        @if ($laporan->laporanPelanggaran)
                                            <tr>
                                                <td colspan="3">
                                                    <h4 class="my-75">{{ __('Pelanggaran') }}:</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Jenis Pelanggaran') }}</td>
                                                <td>:</td>
                                                <td>
                                                    {{ $laporan->laporanPelanggaran ? ($laporan->laporanPelanggaran->jenisPelanggaran ? $laporan->laporanPelanggaran->jenisPelanggaran->nama_jenis_pelanggaran : '') : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Sangsi') }}</td>
                                                <td>:</td>
                                                <td>
                                                    {{ $laporan->laporanPelanggaran ? ($laporan->laporanPelanggaran->sangsi ? $laporan->laporanPelanggaran->sangsi->nama_sangsi : '') : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Detail') }}</td>
                                                <td>:</td>
                                                <td>
                                                    {{ $laporan->laporanPelanggaran ? $laporan->laporanPelanggaran->detail : '' }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($laporan->laporanDokumentasi)
                                            <tr>
                                                <td colspan="3">
                                                    <h4 class="my-75">{{ __('Dokumentasi') }}:</h4>
                                                </td>
                                            </tr>
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
                                        @endif
                                    </tbody>
                                </table>
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
