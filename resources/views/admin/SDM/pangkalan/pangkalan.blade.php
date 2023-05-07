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

                        <h4 class="card-title">Data Pangkalan</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pangkalan</th>
                                    <th>Nomor Handphone</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach ($pangkalan as $item)   
                                    <tr>
                                        <td>{{ $i++ }}</td>                                  
                                        <td>{{ $item->nama_pangkalan }}</td>                                    
                                        <td>{{ $item->no_hp }}</td>                                  
                                        <td>{{ $item->alamat }}</td>                                  
                                        <td>
                                            <a href="{{ route('edit.pangkalan', $item->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.pangkalan', $item->id) }}" id="delete" class="btn btn-danger sm" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                            <a href="{{ route('detail.pangkalan', $item->id) }}" id="detail" class="btn btn-success sm" title="Detail"><i class="mdi mdi-account-details"></i></a>
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