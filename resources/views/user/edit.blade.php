@extends('layouts.app')

@section('title', __('Edit User'))

@section('content')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{ __('User') }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{ __('User') }}</a>
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
                        <h4 class="card-title">{{ __('Form Edit User') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="name">{{ __('Nama') }}</label>
                                        <input type="text" id="name"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') ?? $user->name }}" />
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="username">{{ __('Username') }}</label>
                                        <input type="text" id="username"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') ?? $user->username }}" />
                                        @error('username')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="id_bidang">{{ __('Bidang') }}</label>
                                        <select class="form-select @error('id_bidang') is-invalid @enderror"
                                            name="id_bidang" id="id_bidang">
                                            <option value=""></option>
                                            @foreach (dataBidang() as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ old('id_bidang') ?? $user->userDetail->id_bidang == $row->id ? 'selected' : '' }}>
                                                    {{ $row->nama_bidang }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_bidang')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="id_role">{{ __('Role') }}</label>
                                        <select class="form-select @error('id_role') is-invalid @enderror" name="id_role"
                                            id="id_role">
                                            <option value=""></option>
                                            @foreach (dataRole() as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ old('id_role') ?? $user_role == $row->id ? 'selected' : '' }}>
                                                    {{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_role')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="password">{{ __('Password') }}</label>
                                        <input type="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password" />
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label"
                                            for="password_confirmation">{{ __('Konfirmasi Password') }}</label>
                                        <input type="password" id="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" />
                                        @error('password_confirmation')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary me-1">{{ __('Simpan') }}</button>
                                    <a href="{{ route('user.index') }}"
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
