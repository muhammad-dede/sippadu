<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use Illuminate\Http\Request;

class JenisPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JenisPelanggaran::orderBy('nama_jenis_pelanggaran', 'desc')->get();
        return view('jenis-pelanggaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis-pelanggaran.create');
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
            'nama_jenis_pelanggaran' => 'required|string|max:255',
        ]);

        JenisPelanggaran::create([
            'nama_jenis_pelanggaran' => $request->nama_jenis_pelanggaran,
            'active' => 1,
        ]);

        return redirect()->route('jenis-pelanggaran.index')->with('success', __('Berhasil disimpan!'));
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
        $jenis_pelanggaran = JenisPelanggaran::findOrFail($id);
        return view('jenis-pelanggaran.edit', compact('jenis_pelanggaran'));
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
            'nama_jenis_pelanggaran' => 'required|string|max:255',
        ]);

        $jenis_pelanggaran = JenisPelanggaran::findOrFail($id);
        $jenis_pelanggaran->update([
            'nama_jenis_pelanggaran' => $request->nama_jenis_pelanggaran,
        ]);

        return redirect()->route('jenis-pelanggaran.index')->with('success', __('Berhasil disimpan!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $jenis_pelanggaran = JenisPelanggaran::findOrFail($id);
        $jenis_pelanggaran->update([
            'active' => $jenis_pelanggaran->active == 1 ? 0 : 1,
        ]);

        return redirect()->route('jenis-pelanggaran.index');
    }
}
