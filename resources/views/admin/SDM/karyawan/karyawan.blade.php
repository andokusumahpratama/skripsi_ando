@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Sumber Daya Manusia</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Data Karyawan</h4>

                        <table id="datatable" class="table dt-responsive table-bordered  nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Pendidikan</th>
                                    <th>Jabatan</th>
                                    <th>Email</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach ($karyawan as $item)   
                                @if ($item->user_id != Auth::user()->id)
                                    <tr>
                                        <td>{{ $i++ }}</td>                                    
                                        <td>{{ $item->nama_karyawan }}</td>                                  
                                        <td>{{ $item->jenis_kelamin }}</td>                                  
                                        <td>{{ $item->tanggal_lahir }}</td>                                  
                                        <td>{{ $item->pendidikan }}</td>                                  
                                        <td>{{ $item['jabatan']['nama_jabatan'] }}</td>                                  
                                        <td>{{ $item['users']['email'] }}</td>                                  
                                        <td><img src="{{ !empty($item->profile_image) ? asset($item->profile_image) : url('upload/no_image.png') }}" style="width: 90px; height: 90px;"></td>
                                        <td>
                                            <a href="{{ route('edit.karyawan', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.karyawan', $item->id) }}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endif                                  
                                
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