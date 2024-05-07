@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Merk</td>
                                <td>{{ $rsetBarang->merk }}</td>
                            </tr>
                            <tr>
                                <td>NIS</td>
                                <td>{{ $rsetBarang->seri }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ $rsetBarang->spesifikasi }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>{{ $rsetBarang->stok }}</td>
                            </tr>
                            <tr>
                                <td>Rombel</td>
                                <td>{{ $rsetBarang->kategori_id }}</td>
                            </tr>
                        </table>
                    </div>
               </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12  text-center">
                

                <a href="{{ route('barang.index') }}" class="btn btn-md btn-primary mb-3">Back</a>
            </div>
        </div>
    </div>
@endsection