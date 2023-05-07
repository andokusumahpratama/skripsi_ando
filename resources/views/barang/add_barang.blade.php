@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Tambah Barang</h4>
                        
                        <form method="POST" action="{{ route('store.barang') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
                                    @error('nama_barang')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Harga Beli</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}">
                                    @error('harga_beli')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                                                               

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Tambah Barang" />
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

@endsection