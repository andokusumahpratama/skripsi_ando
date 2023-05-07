@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Stok GAS</h4>
                        
                        <form method="POST" action="{{ route('update.stok.barang') }}" enctype="multipart/form-data">
                            @csrf                                                                                  

                            <input class="form-control" type="hidden" id="id" name="id" value="{{ $stokBarang->id }}">
                            
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="hidden" id="barang_id" name="barang_id" value="{{ $stokBarang->barang_id }}">
                                    <input class="form-control" type="text" value="{{ $stokBarang['barang']['nama_barang'] }}" disabled>
                                    @error('barang_id')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->      

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah Stok Isi</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="jumlah_stok_isi" name="jumlah_stok_isi" value="{{ $stokBarang->jumlah_stok_isi }}">
                                    @error('jumlah_stok_isi')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                           

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah Stok Kosong</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="jumlah_stok_kosong" name="jumlah_stok_kosong" value="{{ $stokBarang->jumlah_stok_kosong }}">
                                    @error('jumlah_stok_kosong')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                           

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Edit Stok" />
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>
@endsection