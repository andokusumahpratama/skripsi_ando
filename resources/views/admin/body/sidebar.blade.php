<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        @php
            $id_user = Auth::user()->id;
            $adminData = App\Models\Karyawan::where('user_id', $id_user)->first();
        @endphp
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ !empty($adminData->profile_image) ? asset($adminData->profile_image) : url('upload/no_image.png') }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ $adminData->nama_karyawan }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>                

                @if (Auth::user()->karyawan->jabatan->nama_jabatan == 'Admin')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-list-settings-line"></i>                        
                            <span>Karyawan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('karyawan.all') }}">Karyawan</a></li>
                            <li><a href="{{ route('add.karyawan') }}">Add Karyawan</a></li>
                        </ul>
                    </li>
                @endif                                

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-box-outline"></i>
                        <span>Pangkalan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('pangkalan.all') }}">Pangkalan</a></li>
                        <li><a href="{{ route('add.pangkalan') }}">Add Pangkalan</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-database"></i>
                        <span>Data Barang</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('barang.all') }}">Gas LPG</a></li>
                        <li><a href="{{ route('add.barang')}}">Add Gas LPG</a></li>
                        <li><a href="{{ route('add.harga.barang')}}">Harga Gas LPG</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-vip-crown-line"></i>
                        <span>Stok Barang</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('stokBarang.all')}}">Stok Gas LPG</a></li>
                        <li><a href="{{ route('add.stok.barang')}}">Add Stok Gas LPG</a></li>
                        <li><a href="{{ route('orderTabung.all') }}">Pembelian DO Tabung</a></li>
                    </ul>
                </li> 

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-bank-line"></i>
                        <span>Transaksi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('transaksi.all')}}">Transaksi Penjualan</a></li>
                        <li><a href="{{ route('add.transaksi') }}">Add Transaksi Penjualan</a></li>
                    </ul>
                </li>   
                
                @if (Auth::user()->karyawan->jabatan->nama_jabatan == 'Admin')                    
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fas fa-book-reader"></i>
                            <span>Report</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            {{-- <li><a href="{{ route('laporan.transaksi') }}">Laporan Barang</a></li> --}}
                            {{-- <li><a href="#">Laporan Barang</a></li> --}}
                            <li><a href="{{ route('reward.pangkalan') }}">Reward Pangkalan</a></li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>