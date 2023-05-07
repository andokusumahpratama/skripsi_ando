@extends('admin.admin_master')
@section('admin')
    
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>
                    <div class="page-title-right">                        
                        <form action="{{ route('filter.dashboard') }}" method="POST">        
                            @csrf                    
                            <div class="form-group">
                                <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container="#datepicker6">
                                    <input type="text" class="form-control" name="start" placeholder="Start Date" value="{{ old('start', isset($star) ? $star : '') }}">
                                    <span class="input-group-text">to</span>
                                    <input type="text" class="form-control" name="end" placeholder="End Date" value="{{ old('end', isset($end) ? $end : '') }}">
                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Filter" />
                                </div>
                            </div>
                        </form>                        
                    </div>                    
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body d-inline-block" style="max-height: 200px; min-height: 100px; overflow-x: auto;">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Stok Tabung Isi Awal</p>
                                <h4 class="mb-2">{{$stokData['stok_isi_awal']}}</h4>
                                {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p> --}}
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-shopping-cart-2-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                            
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Stok Tabung Kosong Awal</p>
                                <h4 class="mb-2">{{$stokData['stok_kosong_awal']}}</h4>
                                {{-- <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p> --}}
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-danger rounded-3">
                                    <i class="ri-shopping-cart-2-line font-size-24"></i>   
                                </span>
                            </div>
                        </div>                                              
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Stok Tabung Isi Akhir</p>
                                <h4 class="mb-2">{{$stokData['stok_isi_akhir']}}</h4>
                                {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p> --}}
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-currency-usd font-size-24"></i>
                                </span>
                            </div>
                        </div>                                              
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-13 mb-2">Stok Tabung Kosong Akhir</p>
                                <h4 class="mb-2">{{$stokData['stok_kosong_akhir']}}</h4>
                                {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from previous period</p> --}}
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-sale font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>                                
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Grafik Total Pendapatan {{$year}}</h4>                        

                        <canvas id="lineChart" height="300" width="479" style="display: block; width: auto; height: auto; " class="chartjs-render-monitor"></canvas>

                    </div>
                </div>                
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>                                
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Bar Penjualan Tabung {{$year}}</h4>

                        @php
                            $count = count($barangss);                                                        
                            $colSize = ($count == 0) ? 0 : round(12 / $count);
                        @endphp                        
                        <div class="row text-center">
                            @foreach($barangss as $datax)
                            <div class="col-{{ $colSize }}">
                                <h5 class="mb-0">{{ $datax->total_penebusan }}</h5>
                                <p class="text-muted text-truncate">{{ ucfirst($datax->nama_barang) }}</p>
                            </div>
                            @endforeach
                        </div>

                        <canvas id="bar" height="300" width="479" style="display: block; width: auto; height: auto; " class="chartjs-render-monitor"></canvas>

                    </div>                    
                </div>                
            </div>
        </div>
        <!-- end row -->

        

        {{-- PERHITUNGAN chart--}}                
            @php
                $waktu = [];
                $pembayaran = [];
            @endphp
            @foreach ($transaksiLine as $item)                
                @php
                    if ($MonthOrWeek == 'month') {                        
                        $waktu[] = $item->bulan;
                    }else{
                        $waktu[] = $item->minggu;
                    }
                    $pembayaran[] = $item->jumlah_pembayaran;                    
                @endphp              
            @endforeach        

        {{-- PERHITUNGAN bar--}}               
    </div>
    
</div>

<!-- Chart js -->
<script src="{{ asset('backend/assets/libs/chart.js/Chart.bundle.min.js') }}"></script>
<script>   
    const cek = {!! json_encode($MonthOrWeek) !!};    
    const year = {!! json_encode($year) !!};
    let waktu = {!! json_encode($waktu) !!};    
    if (cek == 'month') {        
        waktu = waktu.map((waktu) => {
            return new Date(year, waktu - 1, 1).toLocaleString('default', { month: 'long' });
        });
    }    
    const bulan = {!! json_encode($month) !!};
    const total = {!! json_encode($pembayaran) !!};    
    const minTotal = Math.min(...total);
    const maxTotal = Math.max(...total);

    const dataBarang = {!! json_encode($data) !!};
    const barang = {!! json_encode($barang) !!};
    // alert(dataBarang);
    // alert(barang);
    const warna = [
        'rgba(255, 99, 132, 0.8)',
        'rgba(66, 245, 72)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)',
        'rgba(255, 99, 132, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)'
    ];

    const dataset = [];
    for(let i = 0; i < barang.length; i++) {
        dataset.push({
            label: barang[i],
            backgroundColor: warna[i],
            borderColor: warna[i],
            borderWidth: 1,
            hoverBackgroundColor: warna[i],
            hoverBorderColor: warna[i],
            data: dataBarang.map((item) => item[i])
        });
    }

</script>
<script src="{{ asset('backend/assets/js/dashboard_chart.js') }}"></script>

@endsection