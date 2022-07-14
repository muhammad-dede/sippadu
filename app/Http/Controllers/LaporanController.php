<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->user()->roles->pluck('name')[0] === 'admin') {
                $data = Laporan::with(['user', 'jenisKegiatan', 'laporanPelanggaran', 'laporanDokumentasi'])->orderBy('created_at', 'desc')->get();
            } else {
                $data = Laporan::with(['user', 'jenisKegiatan', 'laporanPelanggaran', 'laporanDokumentasi'])->where('id_user', auth()->id())->orderBy('created_at', 'desc')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['kegiatan']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['lokasi']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['tanggal']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('kegiatan', function ($data) {
                    return $data->judul_kegiatan;
                })
                ->addColumn('lokasi', function ($data) {
                    return $data->lokasi !== null ? $data->lokasi : $data->alamat;
                })
                ->addColumn('tanggal', function ($data) {
                    return Carbon::parse($data->tgl_kegiatan)->isoFormat('D-MM-Y');
                })
                ->addColumn('opsi', function ($data) {
                    return '<a href="' . route('laporan.edit', $data->id) . '"class="btn btn-sm btn-warning me-1 my-1">Edit</a><a href="' . route('laporan.show', $data->id) . '"class="btn btn-sm btn-info">Detail</a>';
                })
                ->rawColumns(['kegiatan', 'lokasi', 'tanggal', 'opsi'])
                ->make(true);
        }
        return view('laporan.index');
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {

            if (auth()->user()->roles->pluck('name')[0] === 'admin') {
                $validator = Validator::make($request->all(), [
                    'id_bidang' => 'required|string|max:11',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()->toArray()]);
                }
            }

            $validator = Validator::make($request->all(), [
                'judul_kegiatan' => 'required|string|max:255',
                'tgl_kegiatan' => 'required|date',
                'jam_pelaporan' => 'required|date_format:H:i',
                'id_jenis_kegiatan' => 'required|string|max:11',
                'polisi' => 'required|numeric|digits_between:0,11',
                'tni' => 'required|numeric|digits_between:0,11',
                'pol_pp_prov' => 'required|numeric|digits_between:0,11',
                'pol_pp_kabkot' => 'required|numeric|digits_between:0,11',
                'perangkat_daerah_lainnya' => 'required|numeric|digits_between:0,11',
                'lokasi' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'id_jenis_pelanggaran' => 'required|string|max:11',
                'id_sangsi' => 'required|string|max:11',
                'detail' => 'required|string|max:255',
                'dokumen' => 'required|mimes:png,jpeg,jpg,gif|max:2048',
                'keterangan_lainnya' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            $laporan = Laporan::create([
                'id_user' => auth()->id(),
                'id_bidang' => $request->id_bidang ? $request->id_bidang : auth()->user()->userDetail->id_bidang,
                'judul_kegiatan' => ucfirst($request->judul_kegiatan),
                'tgl_kegiatan' => $request->tgl_kegiatan,
                'jam_pelaporan' => $request->jam_pelaporan,
                'id_jenis_kegiatan' => $request->id_jenis_kegiatan,
                'polisi' => $request->polisi,
                'tni' => $request->tni,
                'pol_pp_prov' => $request->pol_pp_prov,
                'pol_pp_kabkot' => $request->pol_pp_kabkot,
                'perangkat_daerah_lainnya' => $request->perangkat_daerah_lainnya,
                'lokasi' => $request->lokasi,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'alamat' => $request->alamat,
                'keterangan_lainnya' => $request->keterangan_lainnya,
            ]);

            $laporan->laporanPelanggaran()->updateOrCreate(['id_laporan' => $laporan->id], [
                'id_laporan' => $laporan->id,
                'id_jenis_pelanggaran' => $request->id_jenis_pelanggaran,
                'id_sangsi' => $request->id_sangsi,
                'detail' => $request->detail,
            ]);

            if ($request->file('dokumen')) {
                if ($laporan->laporanDokumentasi) {
                    File::delete('public/dokumentasi/' . $laporan->laporanDokumentasi->dokumen);
                }

                $dokumen = 'dokumen-' . time() . '.' . $request->dokumen->extension();
                $request->dokumen->move(public_path('dokumentasi'), $dokumen);

                $laporan->laporanDokumentasi()->updateOrCreate(['id_laporan' => $laporan->id], [
                    'id_laporan' => $laporan->id,
                    'dokumen' => $dokumen,
                ]);
            }

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('laporan.index')->with('success', __('Berhasil disimpan!'));
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (!$laporan) {
            return abort('404');
        } else {
            if (auth()->user()->roles->pluck('name')[0] !== 'admin') {
                if ($laporan->id_user !== auth()->id()) {
                    return abort('404');
                }
            }
        }

        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            if (auth()->user()->roles->pluck('name')[0] === 'admin') {
                $validator = Validator::make($request->all(), [
                    'id_bidang' => 'required|string|max:11',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()->toArray()]);
                }
            }

            $validator = Validator::make($request->all(), [
                'judul_kegiatan' => 'required|string|max:255',
                'tgl_kegiatan' => 'required|date',
                'jam_pelaporan' => 'required|date_format:H:i:s',
                'id_jenis_kegiatan' => 'required|string|max:11',
                'polisi' => 'required|numeric|digits_between:0,11',
                'tni' => 'required|numeric|digits_between:0,11',
                'pol_pp_prov' => 'required|numeric|digits_between:0,11',
                'pol_pp_kabkot' => 'required|numeric|digits_between:0,11',
                'perangkat_daerah_lainnya' => 'required|numeric|digits_between:0,11',
                'lokasi' => 'required|string|max:255',
                'latitude' => 'required|string|max:255',
                'longitude' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'id_jenis_pelanggaran' => 'required|string|max:11',
                'id_sangsi' => 'required|string|max:11',
                'detail' => 'required|string|max:255',
                'dokumen' => 'nullable|mimes:png,jpeg,jpg,gif|max:2048',
                'keterangan_lainnya' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            $laporan = Laporan::findOrFail($id);

            $laporan->update([
                'id_bidang' => $request->id_bidang ? $request->id_bidang : auth()->user()->userDetail->id_bidang,
                'judul_kegiatan' => ucfirst($request->judul_kegiatan),
                'tgl_kegiatan' => $request->tgl_kegiatan,
                'jam_pelaporan' => $request->jam_pelaporan,
                'id_jenis_kegiatan' => $request->id_jenis_kegiatan,
                'polisi' => $request->polisi,
                'tni' => $request->tni,
                'pol_pp_prov' => $request->pol_pp_prov,
                'pol_pp_kabkot' => $request->pol_pp_kabkot,
                'perangkat_daerah_lainnya' => $request->perangkat_daerah_lainnya,
                'lokasi' => $request->lokasi,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'alamat' => $request->alamat,
                'keterangan_lainnya' => $request->keterangan_lainnya,
            ]);

            $laporan->laporanPelanggaran()->updateOrCreate(['id_laporan' => $laporan->id], [
                'id_laporan' => $laporan->id,
                'id_jenis_pelanggaran' => $request->id_jenis_pelanggaran,
                'id_sangsi' => $request->id_sangsi,
                'detail' => $request->detail,
            ]);

            if ($request->file('dokumen')) {
                if ($laporan->laporanDokumentasi) {
                    File::delete('public/dokumentasi/' . $laporan->laporanDokumentasi->dokumen);
                }

                $dokumen = 'dokumen-' . time() . '.' . $request->dokumen->extension();
                $request->dokumen->move(public_path('dokumentasi'), $dokumen);

                $laporan->laporanDokumentasi()->updateOrCreate(['id_laporan' => $laporan->id], [
                    'id_laporan' => $laporan->id,
                    'dokumen' => $dokumen,
                ]);
            }

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('laporan.index')->with('success', __('Berhasil disimpan!'));
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (!$laporan) {
            return abort('404');
        } else {
            if (auth()->user()->roles->pluck('name')[0] !== 'admin') {
                if ($laporan->id_user !== auth()->id()) {
                    return abort('404');
                }
            }
        }

        return view('laporan.show', compact('laporan'));
    }
}
