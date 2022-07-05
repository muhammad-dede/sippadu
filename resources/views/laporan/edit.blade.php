@extends('layouts.app')

@section('title', __('Edit Laporan'))

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
                                    {{ __('Edit') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-vertical-layouts">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>{{ __('Form Edit Laporan') }}</h4>
                            <small class="text-primary">{{ __('Lengkapi data dibawah dengan benar!') }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" id="form-laporan"
                            action="{{ route('laporan.update', $laporan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                {{-- Kegiatan --}}
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="divider divider-start">
                                            <div class="divider-text">{{ __('Kegiatan :') }}</div>
                                        </div>
                                        <div class="row">
                                            @role('admin')
                                                <div class="col-12">
                                                    <div class="mb-1 row">
                                                        <div class="col-sm-3">
                                                            <label class="col-form-label"
                                                                for="id_bidang">{{ __('Bidang') }}</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <select class="select2 form-select" id="id_bidang" name="id_bidang">
                                                                <option value=""></option>
                                                                @foreach (dataBidang() as $row)
                                                                    <option value="{{ $row->id }}"
                                                                        {{ $laporan->id_bidang == $row->id ? 'selected' : '' }}>
                                                                        {{ $row->nama_bidang }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endrole
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="tgl_kegiatan">{{ __('Tanggal Kegiatan') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="date" id="tgl_kegiatan" class="form-control"
                                                            name="tgl_kegiatan" value="{{ $laporan->tgl_kegiatan }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="jam_pelaporan">{{ __('Jam Pelaporan') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="time" id="jam_pelaporan" class="form-control"
                                                            name="jam_pelaporan" value="{{ $laporan->jam_pelaporan }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="id_jenis_kegiatan">{{ __('Jenis Kegiatan') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <select class="select2 form-select" id="id_jenis_kegiatan"
                                                            name="id_jenis_kegiatan">
                                                            <option value=""></option>
                                                            @foreach (dataJenisKegiatan() as $row)
                                                                <option value="{{ $row->id }}"
                                                                    {{ $laporan->id_jenis_kegiatan == $row->id ? 'selected' : '' }}>
                                                                    {{ $row->nama_jenis_kegiatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Personil --}}
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="divider divider-start">
                                            <div class="divider-text">{{ __('Jumlah Personil Yang Terlibat :') }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="polisi">{{ __('Polisi') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="polisi" class="form-control"
                                                            name="polisi" value="{{ $laporan->polisi }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="tni">{{ __('TNI') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="tni" class="form-control"
                                                            name="tni" value="{{ $laporan->tni }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="pol_pp">{{ __('Pol PP Kab/Kota') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="pol_pp" class="form-control"
                                                            name="pol_pp" value="{{ $laporan->pol_pp }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="perangkat_daerah_lainnya">{{ __('Perangkat Daerah Lainnya  ') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="perangkat_daerah_lainnya"
                                                            class="form-control" name="perangkat_daerah_lainnya"
                                                            value="{{ $laporan->perangkat_daerah_lainnya }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Lokasi --}}
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="divider divider-start">
                                            <div class="divider-text">{{ __('Lokasi Kegiatan :') }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="lokasi">{{ __('Lokasi') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="lokasi" class="form-control"
                                                            name="lokasi" value="{{ $laporan->lokasi }}"
                                                            placeholder="Cari Lokasi" />
                                                        {{-- Google Maps --}}
                                                        <div id="map"
                                                            style=" height: 50vh;width: 100%;margin-top: 10px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="latitude">{{ __('Latitude') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="latitude" class="form-control"
                                                            name="latitude" value="{{ $laporan->latitude }}"
                                                            readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="longitude">{{ __('Longitude') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="longitude" class="form-control"
                                                            name="longitude" value="{{ $laporan->longitude }}"
                                                            readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="alamat">{{ __('Alamat Lengkap') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="alamat" class="form-control"
                                                            name="alamat" value="{{ $laporan->alamat }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Pelanggaran --}}
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="divider divider-start">
                                            <div class="divider-text">{{ __('Pelanggaran :') }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="id_jenis_pelanggaran">{{ __('Jenis Pelanggaran') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <select class="select2 form-select" id="id_jenis_pelanggaran"
                                                            name="id_jenis_pelanggaran">
                                                            <option value=""></option>
                                                            @foreach (dataJenisPelanggaran() as $row)
                                                                <option value="{{ $row->id }}"
                                                                    {{ $laporan->laporanPelanggaran->id_jenis_pelanggaran == $row->id ? 'selected' : '' }}>
                                                                    {{ $row->nama_jenis_pelanggaran }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="id_sangsi">{{ __('Sangsi') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <select class="select2 form-select" id="id_sangsi"
                                                            name="id_sangsi">
                                                            <option value=""></option>
                                                            @foreach (dataSangsi() as $row)
                                                                <option value="{{ $row->id }}"
                                                                    {{ $laporan->laporanPelanggaran->id_sangsi == $row->id ? 'selected' : '' }}>
                                                                    {{ $row->nama_sangsi }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="detail">{{ __('Detail') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="detail" class="form-control"
                                                            name="detail"
                                                            value="{{ $laporan->laporanPelanggaran->detail }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Dokumentasi --}}
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="divider divider-start">
                                            <div class="divider-text">{{ __('Dokumentasi :') }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="dokumen">{{ __('Foto') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="border rounded p-2">
                                                            <div class="d-flex flex-column flex-md-row">
                                                                <img src="{{ asset('') }}public/dokumentasi/{{ $laporan->laporanDokumentasi->dokumen }}"
                                                                    id="dokumen-image" class="rounded me-2 mb-1 mb-md-0"
                                                                    width="170" height="110"
                                                                    alt="{{ __('Dokumentasi') }}" />
                                                                <div class="featured-info">
                                                                    <small class="text-muted">
                                                                        Max image size 2mb.
                                                                    </small>
                                                                    <p class="my-50">
                                                                        <span
                                                                            id="dokumen-text">{{ $laporan->laporanDokumentasi->dokumen }}</span>
                                                                    </p>
                                                                    <div class="d-inline-block">
                                                                        <input class="form-control" type="file"
                                                                            id="dokumen" accept="image/*"
                                                                            name="dokumen" />
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
                                {{-- Lainnya --}}
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="divider divider-start">
                                            <div class="divider-text">{{ __('Lainnya :') }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="keterangan_lainnya">{{ __('Keterangan') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <textarea name="keterangan_lainnya" class="form-control" id="keterangan_lainnya" cols="30" rows="3">{{ $laporan->keterangan_lainnya }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary me-1"
                                        id="btn-save">{{ __('Simpan') }}</button>
                                    <a href="{{ route('laporan.index') }}"
                                        class="btn btn-outline-secondary">{{ __('Kembali') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('') }}public/assets/js/laporan/edit/maps.js"></script>
    <script src="{{ asset('') }}public/assets/js/laporan/edit/update.js"></script>
    <script>
        $(document).ready(function() {
            // Select2
            $('.select2').each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>');
                $this.select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    dropdownParent: $this.parent()
                });
            });

            // Dokumen
            var dokumenImage = $('#dokumen-image');
            var dokumenText = document.getElementById('dokumen-text');
            var dokumenInput = $('#dokumen');
            // Change dokumen image
            if (dokumenInput.length) {
                $(dokumenInput).on('change', function(e) {
                    var reader = new FileReader(),
                        files = e.target.files;
                    reader.onload = function() {
                        if (dokumenImage.length) {
                            dokumenImage.attr('src', reader.result);
                        }
                    };
                    reader.readAsDataURL(files[0]);
                    dokumenText.innerHTML = dokumenInput.val();
                });
            }
        });
    </script>
@endpush
