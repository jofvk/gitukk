@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Tanggal Barang keluar</td>
                                <td>{{ $rsetBarangkeluar->tgl_keluar }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Barang keluar</td>
                                <td>{{ $rsetBarangkeluar->qty_keluar }}</td>
                            </tr>
                            <tr>
                                <td>Barang ID</td>
                                <td>{{ $rsetBarangkeluar->barang_id }}</td>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12  text-center">
                

                <a href="{{ route('barangkeluar.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection