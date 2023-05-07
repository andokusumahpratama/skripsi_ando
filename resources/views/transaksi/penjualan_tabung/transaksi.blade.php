@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Transaksi</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Data Transaksi</h4>                        
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <div class="my-4">
                                <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Cetak Laporan</button>
                            </div>


                            <!--  Modal content for the above example -->
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myLargeModalLabel">Nota</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('laporan.transaksi') }}" method="POST" target="_blank">
                                                @csrf

                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pangkalan Gas</label>
                                                    <div class="col-sm-10">
                                                        <select name="pangkalan" class="form-select" aria-label="Default select example">
                                                            <option selected="" value="">Open this select menu</option>    
                                                            @foreach ($pangkalan as $item)                                            
                                                                <option value="{{ $item->id }}">{{ $item->nama_pangkalan }}</option>                                        
                                                            @endforeach                                    
                                                        </select>
                                                        @error('pangkalan')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- end row -->
    
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">From Tanggal</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="date" id="start_date" name="start_date" value="{{ old('start_date') }}">                                                        
                                                        @error('start_date')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- end row -->
    
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">To Tanggal</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="date" id="end_date" name="end_date" value="{{ old('end_date') }}">
                                                        @error('end_date')
                                                            <span class="text-danger"> {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>                                                    
                                                    <input type="submit" class="btn btn-danger waves-effect waves-light" value="Download PDF" target="_blank"/>
                                                </div>
                                            </form>
                                        </div>                                        
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pangkalan</th>
                                    <th>Tabung</th>
                                    <th>Jumlah Penebusan</th>
                                    <th>Jumlah Kembali</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach ($transaksi as $item)   
                                    <tr>
                                        <td>{{ $i++ }}</td>                                    
                                        <td>{{ $item['pangkalans']['nama_pangkalan'] }}</td>                                  
                                        <td>{{ ucfirst($item['hargaJualBarang']['barangs']['nama_barang']) }} (Rp. {{ number_format($item['hargaJualBarang']['harga_jual'], 0, ',','.') }})</td>                                  
                                        <td>{{ $item->penebusan_tabung }}</td>                                  
                                        <td>{{ $item->kembali_kabung }}</td>                                  
                                        <td>Rp. {{ number_format( $item->pembayaran, 0, ',','.') }}</td>                                  
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>                                  
                                        <td>
                                            <a href="{{ route('delete.transaksi', $item->id) }}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                            <a href="{{ route('cetak.nota', $item->id) }}" id="nota" class="btn btn-success sm" title="Cetak Nota"><i class="fas fa-file-pdf"></i></a>
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