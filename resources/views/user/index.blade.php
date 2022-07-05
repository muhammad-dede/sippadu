@extends('layouts.app')

@section('title', __('User'))

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
                                <li class="breadcrumb-item active">
                                    {{ __('User') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12">
                <div class="mb-1 breadcrumb-right">
                    <a href="{{ route('user.create') }}" class="dt-button create-new btn btn-primary" id="btn-tambah">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                <line x1="12" y1="5" x2="12" y2="19">
                                </line>
                                <line x1="5" y1="12" x2="19" y2="12">
                                </line>
                            </svg>
                            {{ __('Tambah') }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('No') }}</th>
                                                <th>{{ __('Nama') }}</th>
                                                <th>{{ __('Username') }}</th>
                                                <th>{{ __('Bidang') }}</th>
                                                <th>{{ __('Opsi') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->username }}</td>
                                                    <td>{{ $row->userDetail ? $row->userDetail->bidang->nama_bidang : '' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('user.edit', $row->id) }}"
                                                            class="btn btn-sm btn-secondary">
                                                            {{ __('Edit') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endpush
