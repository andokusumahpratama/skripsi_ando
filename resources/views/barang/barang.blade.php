@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Data GAS</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Data Barang</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Jual</th>
                                    <th>Harga Beli</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach ($barang as $item)   
                                @php
                                    $daftar_harga_jual = App\Models\JualTabung::where('barangt_id', $item->id)->get();    
                                @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>                                  
                                        <td>{{ ucfirst($item->nama_barang) }} </td>                                    
                                        <td>
                                            <ul>
                                                @foreach ($daftar_harga_jual as $barangs)
                                                    <li>Rp. {{ number_format($barangs->harga_jual, 0, ',','.') }}</li>
                                                @endforeach
                                            </ul>
                                        </td>                                  
                                        <td>Rp. {{ number_format($item->harga_beli, 0, ',','.') }}</td>                                  
                                        <td>
                                            <a href="{{ route('edit.barang', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.barang', $item->id) }}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
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