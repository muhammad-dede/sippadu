@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <!-- Login-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            <h2 class="card-title fw-bold mb-1">
                <img src="{{ asset('') }}public/sippadu.png" alt="" class="w-100">
            </h2>
            <p class="card-text mb-2">{{ __('Masuk') }} {{ config('app.name_2') }}</p>
            <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-1">
                    <label class="form-label" for="username">{{ __('Nama pengguna') }}</label>
                    <input class="form-control" id="username" type="text" name="username" placeholder="sippadu"
                        aria-describedby="username" autofocus="" tabindex="1" value="{{ old('username') }}" />
                    @error('username')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="mb-1">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="login-password">{{ __('Password') }}</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                <small>{{ __('Lupa Password') }}</small>
                            </a>
                        @endif
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input class="form-control form-control-merge" id="password" type="password" name="password"
                            placeholder="············" aria-describedby="password" tabindex="2" />
                        <span class="input-group-text cursor-pointer">
                            <i data-feather="eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <small class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="mb-1">
                    <div class="form-check">
                        <input name="remember" class="form-check-input" id="remember" type="checkbox" tabindex="3"
                            {{ old('remember') ? 'checked' : '' }} />
                        <label class="form-check-label" for="remember"> {{ __('Ingat Saya') }}</label>
                    </div>
                </div>
                <button class="btn btn-primary w-100" tabindex="4">{{ __('Masuk') }}</button>
            </form>
            @if (Route::has('register'))
                <p class="text-center mt-2">
                    <span>{{ __('Belum punya akun') }}?</span>
                    <a href="{{ route('register') }}">
                        <span>&nbsp;{{ __('Daftar') }}</span>
                    </a>
                </p>
            @endif
        </div>
    </div>
    <!-- /Login-->
@endsection
