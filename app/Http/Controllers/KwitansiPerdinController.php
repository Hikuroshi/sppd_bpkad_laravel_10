<?php

namespace App\Http\Controllers;

use App\Models\KegiatanSub;
use App\Models\KwitansiPerdin;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Lama;
use App\Models\StatusPerdin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KwitansiPerdinController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        // return json_encode(KwitansiPerdin::all());
        return view('dashboard.perdin.kwitansi-perdin.index', [
            'title' => 'Daftar Laporan Perdin',
            'kwitansi_perdins' => KwitansiPerdin::all(),
        ]);
    }

    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    */
    public function show(KwitansiPerdin $kwitansiPerdin)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(KwitansiPerdin $kwitansiPerdin)
    {
        if (!$kwitansiPerdin->data_perdin->status->lap) {
            return abort(404);
        }

        return view('dashboard.perdin.kwitansi-perdin.edit', [
            'title' => 'Perbarui Kwitansi Perdin',
            'kwitansi_perdin' => $kwitansiPerdin,
            'kegiatan_subs' => KegiatanSub::all(),
        ]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, KwitansiPerdin $kwitansiPerdin)
    {

        if (!$kwitansiPerdin->data_perdin->status->lap) {
            return abort(404);
        }

        return DB::transaction(function () use ($request, $kwitansiPerdin) {
            $validatedData = $request->validate([
                'tgl_bayar' => 'nullable|date',
                'no_rek' => 'required',
                'kegiatan_sub_id' => 'required',
                'bbm' => 'nullable|integer',
                'tol' => 'nullable|integer',
            ]);

            $validatedData['author_id'] = auth()->user()->id;

            $kwitansiPerdin->update($validatedData);
            StatusPerdin::where('id', $kwitansiPerdin->data_perdin->status_id)->update(['kwitansi' => 1]);

            foreach ($kwitansiPerdin->pegawais as $pegawai) {
                $pegawaiId = $pegawai->id;
                //uang harian
                $uangharian = explode(".",$request->input("uang_harian.$pegawaiId"));
                $uangharian = implode("",$uangharian);
                //uang transport
                $uangtransport = explode(".",$request->input("uang_transport.$pegawaiId"));
                $uangtransport = implode("",$uangtransport);
                //uang tiket
                $uangtiket = explode(".",$request->input("uang_tiket.$pegawaiId"));
                $uangtiket = implode("",$uangtiket);
                //uang penginapan
                $uangpenginapan = explode(".",$request->input("uang_penginapan.$pegawaiId"));
                $uangpenginapan = implode("",$uangpenginapan);

        // return json_encode($uangharian);
                $pegawai->pivot->update([
                    'uang_harian' => $uangharian,
                    'uang_transport' => $uangtransport,
                    'uang_tiket' => $uangtiket,
                    'uang_penginapan' => $uangpenginapan,
                ]);
            }

            return redirect()->back()->with('success', 'Kwitansi Perdin berhasil disimpan! Silahkan cetak Kwitansi!');
        }, 2);
    }


    /**
    * Remove the specified resource from storage.
    */
    public function destroy(KwitansiPerdin $kwitansiPerdin)
    {
        //
    }
}
