@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Sumber Daya Manusia</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Data Pangkalan</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Isi</th>
                                    <th>Stok Kosong</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach ($stokBarang as $item)   
                                    <tr>
                                        <td>{{ $i++ }}</td>                                  
                                        <td>{{ $item['barang']['nama_barang'] }}</td>                                    
                                        <td>{{ $item->jumlah_stok_isi }}</td>                                  
                                        <td>{{ $item->jumlah_stok_kosong }}</td>                                  
                                        <td>
                                            <a href="{{ route('edit.stok.barang', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.stok.barang', $item->id) }}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div>
</div>

@endsection