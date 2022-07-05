<?php

namespace App\Http\Controllers;

use App\Models\JenisKegiatan;
use Illuminate\Http\Request;

class JenisKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JenisKegiatan::orderBy('nama_jenis_kegiatan', 'desc')->get();
        return view('jenis-kegiatan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis-kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_kegiatan' => 'required|string|max:255',
        ]);

        JenisKegiatan::create([
            'nama_jenis_kegiatan' => $request->nama_jenis_kegiatan,
            'active' => 1,
        ]);

        return redirect()->route('jenis-kegiatan.index')->with('success', __('Berhasil disimpan!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis_kegiatan = JenisKegiatan::findOrFail($id);
        return view('jenis-kegiatan.edit', compact('jenis_kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_kegiatan' => 'required|string|max:255',
        ]);

        $jenis_kegiatan = JenisKegiatan::findOrFail($id);
        $jenis_kegiatan->update([
            'nama_jenis_kegiatan' => $request->nama_jenis_kegiatan,
        ]);

        return redirect()->route('jenis-kegiatan.index')->with('success', __('Berhasil disimpan!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $jenis_kegiatan = JenisKegiatan::findOrFail($id);
        $jenis_kegiatan->update([
            'active' => $jenis_kegiatan->active == 1 ? 0 : 1,
        ]);

        return redirect()->route('jenis-kegiatan.index');
    }
}
