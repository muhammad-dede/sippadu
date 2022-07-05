@extends('layouts.app')

@section('content')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">{{ __('Beranda') }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ __('Beranda') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="dashboard-analytics">
                <div class="row match-height">

                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="card card-congratulations">
                            <div class="card-body text-center">
                                <img src="{{ asset('') }}public/app-assets/images/elements/decore-left.png"
                                    class="congratulations-img-left" alt="card-img-left" />
                                <img src="{{ asset('') }}public/app-assets/images/elements/decore-right.png"
                                    class="congratulations-img-right" alt="card-img-right" />
                                <div class="avatar avatar-xl bg-primary shadow">
                                    <div class="avatar-content">
                                        <i data-feather="book-open" class="font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-1 text-white">{{ __('Selamat datang') }}, {{ auth()->user()->name }}
                                    </h1>
                                    <p class="card-text m-auto w-75">
                                        {{ config('app.name_2') }}
                                    </p>
                                    <a href="{{ route('laporan.create') }}"
                                        class="btn btn-primary mt-2">{{ __('Buat Laporan') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-developer-meetup">
                            <div class="meetup-img-wrapper rounded-top text-center">
                                <img src="{{ asset('') }}public/app-assets/images/illustration/email.svg"
                                    alt="Meeting Pic" height="170" />
                            </div>
                            <div class="card-body">
                                <div class="meetup-header d-flex align-items-center">
                                    <div class="my-auto">
                                        <h4 class="card-title mb-25">{{ auth()->user()->name }}</h4>
                                        @if (auth()->user()->userDetail)
                                            <p class="card-text mb-0">
                                                {{ auth()->user()->userDetail->bidang->nama_bidang }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-0">
                                    <div class="avatar float-start bg-light-primary rounded me-1">
                                        <div class="avatar-content">
                                            <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
                                        </div>
                                    </div>
                                    <div class="more-info">
                                        <h6 class="mb-0" id="date-part"></h6>
                                        <small id="time-part"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('') }}public/assets/vendors/moment-js/moment-with-locales.js"></script>
    <script>
        $(document).ready(function() {
            var interval = setInterval(function() {
                var momentNow = moment().locale("id");
                $('#date-part').html(momentNow.format('dddd') + ', ' + momentNow.format('LL'));
                $('#time-part').html(momentNow.format('hh:mm:ss'));
            }, 100);
        });
    </script>
@endpush
