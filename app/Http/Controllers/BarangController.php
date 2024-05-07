<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rsetBarang = Barang::all();
        return view('vbarang.index',compact('rsetBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriId = Kategori::all();
        return view('vbarang.create',compact('kategoriId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'merk'              => 'required',
            'seri'              => 'required',
            'spesifikasi'       => 'required',
            'stok'              => '',
            'kategori_id'       => 'required'
        ]);


        //create post
        Barang::create([
            'merk'          => $request->merk,
            'seri'          => $request->seri,
            'spesifikasi'   => $request->spesifikasi,
            'stok'          => $request->stok,
            'kategori_id'   => $request->kategori_id
        ]);

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBarang = Barang::find($id);

        return view('vbarang.show', compact('rsetBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategoriId = Kategori::all();
        $namaProduk = Barang::with('kategori')->get();
        $rsetBarang = Barang::find($id);
        // Ganti Kategori::find($id) menjadi Barang::find($id)
        $dataYangSedangDiedit = Barang::find($id);
        //return $rsetBarang;
        return view('vbarang.edit', compact('rsetBarang', 'kategoriId', 'namaProduk', 'dataYangSedangDiedit'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $this->validate($request, [
            'merk'        => 'required',
            'seri'        => 'required',
            'spesifikasi' => 'required',
            'stok'        => '',
            'kategori_id' => 'required'
        ]);
    
        // Mendapatkan data barang yang sedang diedit
        $rsetBarang = Barang::find($id);
    
        // Cek jika data barang ditemukan
        if (!$rsetBarang) {
            return redirect()->route('barang.index')->with(['error' => 'Data barang tidak ditemukan!']);
        }
    
        // Logika validasi dan penyimpanan data yang diubah
        $rsetBarang->update([
            'merk'          => $request->merk,
            'seri'          => $request->seri,
            'spesifikasi'   => $request->spesifikasi,
            'stok'          => $request->stok,
            'kategori_id'   => $request->kategori_id
        ]);
    

    
        // Redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        if (DB::table('barangmasuk')->where('barang_id', $id)->exists() || DB::table('barangkeluar')->where('barang_id', $id)->exists()){
            return redirect()->route('barang.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } else {
            $rsetKategori = Barang::find($id);
            $rsetKategori->delete();
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}