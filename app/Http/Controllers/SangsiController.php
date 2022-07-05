<?php

namespace App\Http\Controllers;

use App\Models\Sangsi;
use Illuminate\Http\Request;

class SangsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sangsi::orderBy('nama_sangsi', 'desc')->get();
        return view('sangsi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sangsi.create');
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
            'nama_sangsi' => 'required|string|max:255',
        ]);

        Sangsi::create([
            'nama_sangsi' => $request->nama_sangsi,
            'active' => 1,
        ]);

        return redirect()->route('sangsi.index')->with('success', __('Berhasil disimpan!'));
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
        $sangsi = Sangsi::findOrFail($id);
        return view('sangsi.edit', compact('sangsi'));
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
            'nama_sangsi' => 'required|string|max:255',
        ]);

        $sangsi = Sangsi::findOrFail($id);
        $sangsi->update([
            'nama_sangsi' => $request->nama_sangsi,
        ]);

        return redirect()->route('sangsi.index')->with('success', __('Berhasil disimpan!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $sangsi = Sangsi::findOrFail($id);
        $sangsi->update([
            'active' => $sangsi->active == 1 ? 0 : 1,
        ]);

        return redirect()->route('sangsi.index');
    }
}
