@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Data Transaksi Hutang</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Riwayat Transaksi Pembayaran Hutang</h4>                        

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Bayar Hutang Pembelian</th>
                                    <th>Bayar Hutang Tabung</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach ($riwayat as $item)   
                                    <tr>
                                        <td>{{ $i++ }}</td>                                  
                                        <td>{{ ucfirst($item->hutang_tabung->nama_barang) }} </td>                                    
                                        <td>{{ $item->bayar_hutang_pembelian }}</td>                                  
                                        <td>{{ $item->bayar_hutang_tabung }}</td> 
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>                                 
                                        <td>
                                            <a href="{{ route('delete.riwayat.hutang', $item->id) }}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
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