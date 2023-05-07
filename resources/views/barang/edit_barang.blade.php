@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Edit Barang</h4>

                        @php
                            $daftar_harga_jual = App\Models\JualTabung::where('barangt_id', $barang->id)->get();    
                        @endphp
                        
                        <form method="POST" action="{{ route('update.barang') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $barang->id }}">

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}">
                                    @error('nama_barang')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Harga Beli</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="harga_beli" name="harga_beli" value="{{ $barang->harga_beli }}">
                                    @error('harga_beli')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->       

                            @php
                                $i = 1;
                                $b = 1;
                            @endphp
                            @foreach ($daftar_harga_jual as $item)                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Harga Jual Barang {{$i}}</label>
                                    <div class="col-sm-2">
                                        <input type="hidden" name="id_jual[{{$b++}}]" value="{{ $item->id }}">
                                        <input class="form-control" type="text" id="harga_jual" name="harga_jual[{{$i++}}]" value="{{ $item->harga_jual }}">
                                        @error('harga_jual.'.($i-1))
                                            <span class="text-danger"> {{$message}} </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="{{ route('delete.harga.barang', $item->id) }}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </div>
                                <!-- end row -->
                            @endforeach                                                                                                                      

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Edit Barang" />
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

@endsection