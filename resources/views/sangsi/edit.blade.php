@extends('layouts.app')

@section('title', __('Edit Sangsi'))

@section('content')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{ __('Sangsi') }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('sangsi.index') }}">{{ __('Sangsi') }}</a>
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
                        <h4 class="card-title">{{ __('Form Edit Sangsi') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('sangsi.update', $sangsi->id) }}"
                            method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="nama_sangsi">{{ __('Nama Sangsi') }}</label>
                                        <input type="text" id="nama_sangsi"
                                            class="form-control @error('nama_sangsi') is-invalid @enderror"
                                            name="nama_sangsi" value="{{ old('nama_sangsi') ?? $sangsi->nama_sangsi }}" />
                                        @error('nama_sangsi')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary me-1">{{ __('Simpan') }}</button>
                                    <a href="{{ route('sangsi.index') }}"
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
