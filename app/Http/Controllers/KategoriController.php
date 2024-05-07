<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rsetKategori = Kategori::all();

        return view('vkategori.index',compact('rsetKategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vkategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'deskripsi'         => 'required',
            'kategori'          => 'required|not_in:blank'
        ]);


        //create post
        Kategori::create([
            'deskripsi'         => $request->deskripsi,
            'kategori'          => $request->kategori
        ]);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);


        return view('vkategori.show', compact('rsetKategori')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aKategori = array('blank'=>'Pilih Kategori',
                        'M'=>'Barang Modal',
                        'A'=>'Alat',
                        'BHP'=>'Bahan Habis Pakai',
                        'BTHP'=>'Bahan Tidak Habis Pakai'
                    );

        $rsetKategori = Kategori::find($id);
        //return $rsetKategori;
        return view('vkategori.edit', compact('rsetKategori','aKategori'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'deskripsi'    => 'required',
            'kategori'     => 'required|not_in:blank'
        ]);

        $rsetKategori = Kategori::find($id);

        //check if image is uploaded
        if ($request->hasFile('foto')) {

            //upload new image
            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            //delete old image
            Storage::delete('public/foto/'.$rsetKategori->foto);

            //update post with new image
            $rsetKategori->update([
                'deskripsi'         => $request->deskripsi,
                'kategori'          => $request->kategori
            ]);

        } else {

            //update post without image
            $rsetKategori->update([
                'deskripsi'         => $request->deskripsi,
                'kategori'          => $request->kategori
            ]);
        }

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         if (DB::table('barang')->where('kategori_id', $id)->exists()){
                return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
            } else {
                $rsetKategori = Kategori::find($id);
                $rsetKategori->delete();
                return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
            }
    }
}
