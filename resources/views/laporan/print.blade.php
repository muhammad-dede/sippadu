<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $laporan->judul_kegiatan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <h1 class="text-center">{{ __('Laporan Kegiatan') }}</h1>
    <hr>
    <table class="table">
        <tbody>
            <tr>
                <td colspan="3">
                    <h4>{{ __('Laporan Kegiatan') }}:</h4>
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
                    <h4 class="mt-4">{{ __('Jumlah Personil Yang Terlibat') }}:</h4>
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
                    <h4 class="mt-4">{{ __('Lokasi') }}:</h4>
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
                        <h4 class="mt-4">{{ __('Pelanggaran') }}:</h4>
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
                        <h4 class="mt-4">{{ __('Dokumentasi') }}:</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if ($laporan->laporanDokumentasi->dokumen)
                            <a href="{{ asset('') }}public/dokumentasi/{{ $laporan->laporanDokumentasi->dokumen }}"
                                target="_blank">
                                <img src="{{ asset('') }}public/dokumentasi/{{ $laporan->laporanDokumentasi->dokumen }}"
                                    alt="dokumen" class="rounded me-2 mb-1 mb-md-0" width="170" height="110">
                            </a>
                        @endif
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
