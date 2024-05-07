@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangmasuk.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG MASUK</a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Masuk</th>
                            <th>Jumlah Barang Masuk</th>
                            <th>Barang ID - Merk</th>

                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rsetBarangMasuk as $barangmasuk)
                            <tr>
                                <td>{{ $barangmasuk->id  }}</td>
                                <td>{{ $barangmasuk->tgl_masuk  }}</td>
                                <td>{{ $barangmasuk->qty_masuk  }}</td>
                                <td>{{ $barangmasuk->barang->id  }} - {{ $barangmasuk->barang->merk  }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangmasuk.destroy', $barangmasuk->id) }}" method="POST">
                                        <a href="{{ route('barangmasuk.show', $barangmasuk->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangmasuk.edit', $barangmasuk->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                        @empty
                            <div class="alert">
                                Data barang masuk belum tersedia
                            </div>
                        @endforelse
                    </tbody>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('Gagal'))
    <div class="alert alert-danger">
        {{ session('Gagal') }}
 </div>
@endif
                </table>
                {{-- {{ $barangmasuk->links() }} --}}

            </div>
        </div>
    </div>
@endsection