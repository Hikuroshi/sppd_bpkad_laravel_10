<?php

namespace App\Http\Controllers;

use App\Models\JabatanKedua;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class JabatanKeduaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.master.jabatan-kedua.index', [
            'title' => 'Daftar Jabatan Kedua',
            'jabatan_keduas' => JabatanKedua::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.master.jabatan-kedua.create', [
            'title' => 'Tambah Jabatan Kedua',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:3|max:100',
        ]);

        $validatedData['slug'] = SlugService::createSlug(JabatanKedua::class, 'slug', $request->nama);
        $validatedData['author_id'] = auth()->user()->id;

        JabatanKedua::create($validatedData);
        return redirect()->route('jabatan-kedua.index')->with('success', 'Jabatan Kedua berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JabatanKedua $jabatanKedua)
    {
        return view('dashboard.master.jabatan-kedua.show', [
            'title' => 'Detail Jabatan Kedua',
            'jabatan_kedua' => $jabatanKedua,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JabatanKedua $jabatanKedua)
    {
        return view('dashboard.master.jabatan-kedua.edit', [
            'title' => 'Perbarui Jabatan Kedua',
            'jabatan_kedua' => $jabatanKedua,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JabatanKedua $jabatanKedua)
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:3|max:100',
        ]);

        $validatedData['slug'] = SlugService::createSlug(JabatanKedua::class, 'slug', $request->nama);
        $validatedData['author_id'] = auth()->user()->id;

        JabatanKedua::where('id', $jabatanKedua->id)->update($validatedData);
        return redirect()->route('jabatan-kedua.index')->with('success', 'Jabatan Kedua berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JabatanKedua $jabatanKedua)
    {
        $jabatanKedua->delete();
        return redirect()->route('jabatan-kedua.index')->with('success', 'Jabatan Kedua berhasil dihapus!');
    }
}
