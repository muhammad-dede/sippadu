@extends('layouts.app')

@section('title', __('Tambah Jenis Pelanggaran'))

@section('content')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{ __('Jenis Pelanggaran') }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('jenis-pelanggaran.index') }}">{{ __('Jenis Pelanggaran') }}</a>
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
                        <h4 class="card-title">{{ __('Form Tambah Jenis Pelanggaran') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('jenis-pelanggaran.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label"
                                            for="nama_jenis_pelanggaran">{{ __('Nama Jenis Pelanggaran') }}</label>
                                        <input type="text" id="nama_jenis_pelanggaran"
                                            class="form-control @error('nama_jenis_pelanggaran') is-invalid @enderror"
                                            name="nama_jenis_pelanggaran" value="{{ old('nama_jenis_pelanggaran') }}" />
                                        @error('nama_jenis_pelanggaran')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary me-1">{{ __('Simpan') }}</button>
                                    <a href="{{ route('jenis-pelanggaran.index') }}"
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
