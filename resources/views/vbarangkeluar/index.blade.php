@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangkeluar.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG KELUAR</a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal keluar</th>
                            <th>Jumlah Barang keluar</th>
                            <th>Barang ID - Merk</th>

                            <th style="width: 15%">AKSI</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rsetBarangkeluar as $barangkeluar)
                            <tr>
                                <td>{{ $barangkeluar->id  }}</td>
                                <td>{{ $barangkeluar->tgl_keluar  }}</td>
                                <td>{{ $barangkeluar->qty_keluar  }}</td>
                                <td>{{ $barangkeluar->barang->id  }} - {{ $barangkeluar->barang->merk  }}</td>
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangkeluar.destroy', $barangkeluar->id) }}" method="POST">
                                        <a href="{{ route('barangkeluar.show', $barangkeluar->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangkeluar.edit', $barangkeluar->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                        @empty
                            <div class="alert">
                                Data barang keluar belum tersedia
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
                {{-- {{ $barangkeluar->links() }} --}}

            </div>
        </div>
    </div>
@endsection