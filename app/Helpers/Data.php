<?php

function dataRole()
{
    return \Spatie\Permission\Models\Role::all();
}

function dataBidang()
{
    return \App\Models\Bidang::where('active', true)->orderBy('nama_bidang', 'asc')->get();
}

function dataJenisKegiatan()
{
    return \App\Models\JenisKegiatan::where('active', true)->orderBy('nama_jenis_kegiatan', 'asc')->get();
}

function dataJenisPelanggaran()
{
    return \App\Models\JenisPelanggaran::where('active', true)->orderBy('nama_jenis_pelanggaran', 'asc')->get();
}

function dataSangsi()
{
    return \App\Models\Sangsi::where('active', true)->orderBy('nama_sangsi', 'asc')->get();
}
