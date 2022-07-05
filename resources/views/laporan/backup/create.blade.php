@extends('layouts.app')

@section('title', __('Tambah Laporan'))

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
                                    {{ __('Tambah') }}
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
                            <h4>{{ __('Form Tambah Laporan') }}</h4>
                            <small class="text-primary">{{ __('Lengkapi data dibawah dengan benar!') }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" id="form-laporan" action="{{ route('laporan.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Kegiatan --}}
                                <div class="col-12">
                                    <div class="mb-1">
                                        <div class="divider divider-start">
                                            <div class="divider-text">{{ __('Kegiatan :') }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1 row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label"
                                                            for="tgl_kegiatan">{{ __('Tanggal Kegiatan') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="date" id="tgl_kegiatan"
                                                            class="form-control @error('tgl_kegiatan') is-invalid @enderror"
                                                            name="tgl_kegiatan" value="{{ old('tgl_kegiatan') }}" />
                                                        @error('tgl_kegiatan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="time" id="jam_pelaporan"
                                                            class="form-control @error('jam_pelaporan') is-invalid @enderror"
                                                            name="jam_pelaporan" value="{{ old('jam_pelaporan') }}" />
                                                        @error('jam_pelaporan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <select
                                                            class="select2 form-select @error('id_jenis_kegiatan') is-invalid @enderror"
                                                            id="id_jenis_kegiatan" name="id_jenis_kegiatan">
                                                            <option value=""></option>
                                                            @foreach (dataJenisKegiatan() as $row)
                                                                <option value="{{ $row->id }}"
                                                                    {{ old('id_jenis_kegiatan') == $row->id ? 'selected' : '' }}>
                                                                    {{ $row->nama_jenis_kegiatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_jenis_kegiatan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="number" id="polisi"
                                                            class="form-control @error('polisi') is-invalid @enderror"
                                                            name="polisi" value="{{ old('polisi') }}" />
                                                        @error('polisi')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="number" id="tni"
                                                            class="form-control @error('tni') is-invalid @enderror"
                                                            name="tni" value="{{ old('tni') }}" />
                                                        @error('tni')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="number" id="pol_pp"
                                                            class="form-control @error('pol_pp') is-invalid @enderror"
                                                            name="pol_pp" value="{{ old('pol_pp') }}" />
                                                        @error('pol_pp')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                            class="form-control @error('perangkat_daerah_lainnya') is-invalid @enderror"
                                                            name="perangkat_daerah_lainnya"
                                                            value="{{ old('perangkat_daerah_lainnya') }}" />
                                                        @error('perangkat_daerah_lainnya')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="text" id="lokasi"
                                                            class="form-control @error('lokasi') is-invalid @enderror"
                                                            name="lokasi" value="{{ old('lokasi') }}"
                                                            placeholder="Lokasi" />
                                                        @error('lokasi')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="text" id="latitude"
                                                            class="form-control @error('latitude') is-invalid @enderror"
                                                            name="latitude" value="{{ old('latitude') }}" readonly />
                                                        @error('latitude')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="text" id="longitude"
                                                            class="form-control @error('longitude') is-invalid @enderror"
                                                            name="longitude" value="{{ old('longitude') }}" readonly />
                                                        @error('longitude')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="text" id="alamat"
                                                            class="form-control @error('alamat') is-invalid @enderror"
                                                            name="alamat" value="{{ old('alamat') }}" />
                                                        @error('alamat')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <select
                                                            class="select2 form-select @error('id_jenis_pelanggaran') is-invalid @enderror"
                                                            id="id_jenis_pelanggaran" name="id_jenis_pelanggaran">
                                                            <option value=""></option>
                                                            @foreach (dataJenisPelanggaran() as $row)
                                                                <option value="{{ $row->id }}"
                                                                    {{ old('id_jenis_pelanggaran') == $row->id ? 'selected' : '' }}>
                                                                    {{ $row->nama_jenis_pelanggaran }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_jenis_pelanggaran')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <select
                                                            class="select2 form-select @error('id_sangsi') is-invalid @enderror"
                                                            id="id_sangsi" name="id_sangsi">
                                                            <option value=""></option>
                                                            @foreach (dataSangsi() as $row)
                                                                <option value="{{ $row->id }}"
                                                                    {{ old('id_sangsi') == $row->id ? 'selected' : '' }}>
                                                                    {{ $row->nama_sangsi }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('id_sangsi')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                        <input type="text" id="detail"
                                                            class="form-control @error('detail') is-invalid @enderror"
                                                            name="detail" value="{{ old('detail') }}" />
                                                        @error('detail')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
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
                                                <div class="row">
                                                    <div class="col-sm-3 mb-1">
                                                        <button type="button" class="btn-add-dokumen btn btn-primary"
                                                            title="{{ __('Tambah Dokumen') }}">
                                                            <i data-feather='plus-circle'></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-9" id="dokumentasi">

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
                                                        <textarea name="keterangan_lainnya" class="form-control" id="keterangan_lainnya" cols="30" rows="3"></textarea>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmer1CCL5lWSFWvVStpXyxkImWuPBSTgI&libraries=places">
    </script>
    <script src="{{ asset('') }}public/assets/js/laporan/create/maps.js"></script>
    {{-- <script src="{{ asset('') }}public/assets/js/laporan/create/store.js"></script> --}}
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

            // Upload Picture
            tambahDokumen();

            function tambahDokumen() {
                html = '<div class="input-group mb-1">';
                html +=
                    '<input name="dokumen[]" type="file" class="form-control" aria-describedby="btn-delete-dokumen" aria-label="Upload" accept="image/*">';
                html +=
                    '<button class="btn btn-outline-danger btn-delete-dokumen" type="button" id="btn-delete-dokumen">x</button>';
                html += '</div>';
                $("#dokumentasi").append(html);
            }

            $(document).on('click', '.btn-add-dokumen', function() {
                event.preventDefault();
                tambahDokumen();
            });

            $(document).on('click', '.btn-delete-dokumen', function() {
                event.preventDefault();
                $(this).closest(".input-group").remove();
            });
        });
    </script>
@endpush
