@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Detail {{$pangkalan->nama_pangkalan}}</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Detail</h4>
                        <div class="my-4">
                            <a href="{{route('riwayat.bayar.hutang', $pangkalan->id)}}" class="btn btn-primary waves-effect waves-light">Riwayat Bayar</a>
                        </div> 

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tabung</th>
                                    <th>Hutang Tabung</th>
                                    <th>Hutang Pembayaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach ($hutang as $item)   
                                    <tr>
                                        <td>{{ $i++ }}</td>                                  
                                        <td>{{ $item['barang_hutang']['nama_barang'] }}</td>                                    
                                        <td>{{ $item->hutang_tabung }}</td>                                  
                                        <td>Rp. {{ number_format( $item->hutang_pembelian, 0, ',','.') }}</td>                                  
                                        <td>
                                            <a href="{{ route('bayar.hutang.pangkalan', $item->id) }}" class="btn btn-success sm" title="Bayar"><i class="fas fa-money-check"></i></a>
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