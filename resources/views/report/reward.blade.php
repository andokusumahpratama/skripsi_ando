@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Nilai Bobot</h4>
                        <p class="card-title-desc">Nilai bobot pada setiap kriteria keputusan
                            menggunakan metode Complex Proportional Assessment</p> --}}
                        
                        <form method="POST" action="{{ route('filter.reward') }}" class="needs-validation" novalidate="" >
                            @csrf
                            
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 card-title">Reward Pangkalan</h4>
                                <div class="page-title-right">                        
                                    <div class="form-group">
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                                            <input type="text" class="form-control" name="start" placeholder="Start Date" value="{{ old('start', isset($star) ? $star : '') }}">
                                            <span class="input-group-text">to</span>
                                            <input type="text" class="form-control" name="end" placeholder="End Date" value="{{ old('end', isset($end) ? $end : '') }}">
                                        </div>
                                    </div>
                                </div>                    
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Bobot Pembayaran</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="t_pembelian_rupiah" placeholder="" required="" value="{{ old('t_pembelian_rupiah', isset($t_pembelian_rupiah) ? $t_pembelian_rupiah : '') }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Bobot Penebusan Tabung</label>
                                        <input type="text" class="form-control" name="t_pembelian_tabung" id="validationCustom02" placeholder="" required="" value="{{ old('t_pembelian_tabung', isset($t_pembelian_tabung) ? $t_pembelian_tabung : '') }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom01" class="form-label">Bobot Hutang Pembayaran</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="t_hutang_pembelian" placeholder="" required="" value="{{ old('t_hutang_pembelian', isset($t_hutang_pembelian) ? $t_hutang_pembelian : '') }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="validationCustom02" class="form-label">Bobot Hutang Tabung</label>
                                        <input type="text" class="form-control" id="validationCustom02" name="t_kurang_kembali_tabung" placeholder="" required="" value="{{ old('t_kurang_kembali_tabung', isset($t_kurang_kembali_tabung) ? $t_kurang_kembali_tabung : '') }}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                        
                            <div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
        
                        <h4 class="card-title mb-4">Latest Transactions</h4>
        
                        <div class="table-responsive">
                            <table id="datatable" class="table dt-responsive table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Pangkalan</th>
                                        <th>Total Pembayaran</th>
                                        <th>Total Penebusan</th>
                                        <th>Total Hutang Pembayaran</th>
                                        <th>Total Hutang Tabung</th>                                        
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                     
                                    @foreach ($data as $item)                                        
                                    <tr>
                                        <td>{{$item['pangkalan']}}</td>
                                        <td>Rp. {{ number_format( $item['total_pembayaran'], 0, ',','.') }}</td>
                                        <td>{{$item['total_penebusan']}}</td>
                                        <td>Rp. {{ number_format( $item['total_hutang_pembayaran'], 0, ',','.') }}</td>
                                        <td>{{$item['total_hutang_tabung']}}</td>
                                    </tr>
                                     <!-- end -->
                                    @endforeach                                                   
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
            
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
        
                        <h4 class="card-title mb-4">Reward Pangkalan</h4>                        
                        <div class="table-responsive">
                            <table id="datatable1" class="table dt-responsive table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Point</th>
                                        <th>Status</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @php
                                        $i=1
                                        // $i = ($copras->currentPage() - 1) * $copras->perPage() + 1
                                    @endphp                                    
                                    @foreach ($copras as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td> 
                                            <td>{{$item->index}}</td>
                                            <td>{{$item->value}}</td>
                                            @if ($i<=11)
                                                <td>Layak</td>
                                            @else    
                                                <td>Tidak layak</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                     <!-- end -->                                     
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                            
                            {{-- PAGINATION MANUAL KALAU OTOMATIS MEMAKE ID datatable1 --}}
                            {{-- <div class="d-flex justify-content-between align-items-center">
                                <div>Showing {{ $copras->firstItem() }} to {{ $copras->lastItem() }} of {{ $copras->total() }} entries</div>
                                <nav aria-label="Page navigation">
                                  <ul class="pagination pagination-rounded">
                                    @if ($copras->currentPage() > 1)
                                      <li class="page-item"><a class="page-link" href="{{ $copras->previousPageUrl() }}">&laquo;</a></li>
                                    @endif
                                    @for ($i = 1; $i <= $copras->lastPage(); $i++)
                                      <li class="page-item {{ ($i == $copras->currentPage()) ? 'active' : '' }} d-inline"><a class="page-link" href="{{ $copras->url($i) }}">{{ $i }}</a></li>
                                    @endfor
                                    @if ($copras->hasMorePages())
                                      <li class="page-item"><a class="page-link" href="{{ $copras->nextPageUrl() }}">&raquo;</a></li>
                                    @endif
                                  </ul>
                                </nav>
                            </div> --}}


                        </div>
                        
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>            
            <!-- end col -->
        </div>                
    </div>
</div>
@endsection