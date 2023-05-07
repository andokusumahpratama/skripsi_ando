@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Bayar Hutang</h4>                        
                        
                        <form method="POST" action="{{ route('update.bayar.pangkalan') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $hutang->id }}">
                            <input type="hidden" name="pangkalan_id" value="{{ $hutang->pangkalan_id }}">
                            <input type="hidden" name="barang_id" value="{{ $hutang->barangss_id }}">

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="nama_barangs" name="nama_barangs" value="{{ $hutang['barang_hutang']['nama_barang'] }}" disabled>
                                    {{-- <input class="form-control" type="hidden" id="nama_barang" name="nama_barang" value="{{ $hutang['barang_hutang']['nama_barang'] }}" disabled> --}}
                                    @error('nama_barang')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Hutang Pembelian</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="hutang_pembelian" name="hutang_pembelian" value="{{ $hutang->hutang_pembelian }}">
                                    @error('hutang_pembelian')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                                                                                                                                                      

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Hutang Tabung</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="hutang_tabung" name="hutang_tabung" value="{{ $hutang->hutang_tabung }}">
                                    @error('hutang_tabung')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                                                                                                                                                      

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update" />
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

@endsection