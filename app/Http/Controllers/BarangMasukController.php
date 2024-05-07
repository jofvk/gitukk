<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rsetBarangMasuk = BarangMasuk::all();
        return view('vbarangmasuk.index',compact('rsetBarangMasuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangId = Barang::all();
        return view('vbarangmasuk.create',compact('barangId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'tgl_masuk'         => 'required',
            'qty_masuk'          => 'required|not_in:blank',
            'barang_id'          => 'required|not_in:blank'

        ]);


        //create post
        BarangMasuk::create([
            'tgl_masuk'         => $request->tgl_masuk,
            'qty_masuk'          => $request->qty_masuk,
            'barang_id'          => $request->barang_id
        ]);

        //redirect to index
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBarangMasuk = BarangMasuk::find($id);
        return view('vbarangmasuk.show', compact('rsetBarangMasuk')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rsetBarangMasuk = BarangMasuk::find($id);
        $barangId = Barang::all();

        if (!$rsetBarangMasuk) {
            return redirect()->route('barangmasuk.index')->with(['error' => 'Data barang masuk tidak ditemukan!']);
        }

        return view('vbarangmasuk.edit', compact('rsetBarangMasuk', 'barangId'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required|not_in:blank',
            'barang_id' => 'required|not_in:blank'
        ]);

        $rsetBarangMasuk = BarangMasuk::find($id);

        if (!$rsetBarangMasuk) {
            return redirect()->route('barangmasuk.index')->with(['error' => 'Data barang masuk tidak ditemukan!']);
        }

        $rsetBarangMasuk->update([
            'tgl_masuk'  => $request->tgl_masuk,
            'qty_masuk'  => $request->qty_masuk,
            'barang_id'  => $request->barang_id
        ]);

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    public function destroy(string $id)
    {
        $rsetBarangMasuk = BarangMasuk::find($id);
        //delete image

        //delete post
        $rsetBarangMasuk->delete();

        //redirect to index
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
