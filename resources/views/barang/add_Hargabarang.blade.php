@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Tambah Harga Barang</h4>
                        
                        <form method="POST" action="{{ route('store.harga.barang') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <select name="barang_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Pilih Barang</option>
                                        @foreach ($barang as $gas)
                                            <option value="{{ $gas->id }}">{{ ucfirst($gas->nama_barang) }}</option>
                                        @endforeach
                                    </select>
                                    @error('barang_id')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Harga Jual</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}">
                                    @error('nama_pangkalan')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                                                                     

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Tambah Harga" />
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

@endsection