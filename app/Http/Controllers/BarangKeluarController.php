<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rsetBarangkeluar = BarangKeluar::all();
        return view('vbarangkeluar.index',compact('rsetBarangkeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangId = Barang::all();
        return view('vbarangkeluar.create',compact('barangId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'tgl_keluar'         => 'required',
            'qty_keluar'          => 'required|not_in:blank',
            'barang_id'          => 'required|not_in:blank'

        ]);


        //create post
        BarangKeluar::create([
            'tgl_keluar'         => $request->tgl_keluar,
            'qty_keluar'          => $request->qty_keluar,
            'barang_id'          => $request->barang_id
        ]);

        //redirect to index
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBarangkeluar = BarangKeluar::find($id);
        return view('vbarangkeluar.show', compact('rsetBarangkeluar')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rsetBarangkeluar = BarangKeluar::find($id);
        $barangId = Barang::all();
    
        if (!$rsetBarangkeluar) {
            return redirect()->route('barangkeluar.index')->with(['error' => 'Data barang keluar tidak ditemukan!']);
        }
    
        return view('vbarangkeluar.edit', compact('rsetBarangkeluar', 'barangId'));
    }
    
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'tgl_keluar'   => 'required',
            'qty_keluar'   => 'required|not_in:blank',
            'barang_id'    => 'required|not_in:blank'
        ]);
    
        $rsetBarangkeluar = BarangKeluar::find($id);
    
        if (!$rsetBarangkeluar) {
            return redirect()->route('barangkeluar.index')->with(['error' => 'Data barang keluar tidak ditemukan!']);
        }
    
        $rsetBarangkeluar->update([
            'tgl_keluar'   => $request->tgl_keluar,
            'qty_keluar'   => $request->qty_keluar,
            'barang_id'    => $request->barang_id
        ]);
    
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rsetBarangKeluar = BarangKeluar::find($id);
        //delete image

        //delete post
        $rsetBarangKeluar->delete();

        //redirect to index
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
