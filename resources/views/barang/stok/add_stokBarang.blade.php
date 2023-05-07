@extends('admin.admin_master')
@section('admin')

<script
  src="https://code.jquery.com/jquery-3.6.3.js"
  integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
  crossorigin="anonymous">
</script>

<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Stok GAS</h4>
                        
                        <form method="POST" action="{{ route('store.stok.barang') }}" enctype="multipart/form-data">
                            @csrf                                               

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <select name="barang_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Open this select menu</option>    
                                        @foreach ($barang as $item)                                            
                                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>                                        
                                        @endforeach                                    
                                    </select>
                                    @error('barang_id')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                      

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah Stok Isi</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="jumlah_stok_isi" name="jumlah_stok_isi" value="{{ old('pendidikan') }}">
                                    @error('jumlah_stok_isi')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                           

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah Stok Kosong</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="jumlah_stok_kosong" name="jumlah_stok_kosong" value="{{ old('pendidikan') }}">
                                    @error('jumlah_stok_kosong')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                           

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Tambah Stok" />
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>
@endsection