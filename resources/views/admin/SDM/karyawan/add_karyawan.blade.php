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

                        <h4 class="card-title mb-4">Tambah Karyawan</h4>
                        
                        <form method="POST" action="{{ route('store.karyawan') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Karyawan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="nama_karyawan" name="nama_karyawan" value="{{ old('nama_karyawan') }}">
                                    @error('nama_karyawan')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jenis_kelamin" class="form-select" aria-label="Default select example">
                                        <option selected="">Open this select menu</option>                                        
                                            <option value="Pria" {{old('jenis_kelamin') == 'Pria' ? 'selected':''}}>Pria</option>                                        
                                            <option value="Perempuan" {{old('jenis_kelamin') == 'Perempuan' ? 'selected':''}}>Perempuan</option>                                        
                                    </select>
                                    @error('jenis_kelamin')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" id="example-date-input" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                    @error('tanggal_lahir')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                           

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Pendidikan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}">
                                    @error('pendidikan')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                           

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <select name="jabatan" class="form-select" aria-label="Default select example">
                                        <option selected="">Open this select menu</option>                                        
                                        @foreach ($jabatan as $job)
                                            <option value="{{ $job->id }}" {{old('jabatan') == $job->id ? 'selected':''}}>{{ $job->nama_jabatan }}</option>
                                        @endforeach                                        
                                    </select>
                                    @error('jabatan')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                           

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" id="email" name="email">
                                    @error('email')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                           

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" id="password" name="password">
                                    @error('password')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                           
                    
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="image" name="profile_image"> 
                                    @error('profile_image')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror                                 
                                </div>
                            </div>                            
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10">
                                    <img id="showImage" class="rounded avatar-lg"  src="{{ url('upload/no_image.png') }}" alt="Card image cap">
                                </div>
                            </div>

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Tambah Karyawan" />
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#image').change(function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0'])
        });
    });
</script>

@endsection