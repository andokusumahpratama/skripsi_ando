@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Tambah Pangkalan</h4>
                        
                        <form method="POST" action="{{ route('store.pangkalan') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Pangkalan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="nama_pangkalan" name="nama_pangkalan" value="{{ old('nama_pangkalan') }}">
                                    @error('nama_pangkalan')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nomor Handphone</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea required="" class="form-control" rows="5" name="alamat"></textarea>     
                                    @error('alamat')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror                               
                                </div>
                            </div>                            
                            <!-- end row -->                                                                       

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Tambah Pangkalan" />
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

@endsection