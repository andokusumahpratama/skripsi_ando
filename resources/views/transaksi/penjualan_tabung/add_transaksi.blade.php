@extends('admin.admin_master')
@section('admin')

<!-- Select Add transaksi -->
<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Tambah Transaksi</h4>
                        
                        <form method="POST" action="{{ route('store.transaksi') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Pangkalan</label>
                                <div class="col-sm-10">
                                    <select name="pangkalan_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Pilih Pangkalan</option>
                                        @foreach ($pangkalan as $costumer)
                                            <option value="{{ $costumer->id }}">{{ $costumer->nama_pangkalan }}</option>
                                        @endforeach
                                    </select>
                                    @error('pangkalan_id')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->                            

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <select name="jual_tabung_id" id="jual_tabung_id" class="form-select" onchange="updateTotal()" aria-label="Default select example">
                                        <option selected="">Pilih Barang</option>                                                                                
                                        @foreach ($barang as $tabung)
                                            <option value="{{$tabung->id}}" data-harga="{{$tabung->harga_jual}}">{{ucfirst($tabung->nama_barang)}} | Rp. {{ number_format($tabung->harga_jual, 0, ',','.') }}</option>
                                        @endforeach
                                    </select>
                                    @error('jual_tabung_id')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->
                            
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah Penebusan Tabung</label>
                                <div class="col-sm-10">
                                    <input class="form-control" onchange="updateTotal()" type="text" id="penebusan_tabung" name="penebusan_tabung" value="{{ old('penebusan_tabung') }}">
                                    @error('penebusan_tabung')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah Kembali Tabung</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="kembali_tabung" name="kembali_tabung" value="{{ old('kembali_tabung') }}" onblur="validateKembaliTabung()">
                                    <span id="kembali_tabung_error" class="text-danger"></span>
                                    @error('kembali_tabung')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->
                            
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Pembayaran</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="pembayaran" name="pembayaran" value="{{ old('pembayaran') }}">
                                    @error('kembali_tabung')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Total</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="total_pembayaran" name="total_pembayaran" value="{{ old('total_pembayaran') }}" disabled>
                                    <input class="form-control" type="hidden" id="total_pembayaran2" name="total_pembayaran" value="{{ old('total_pembayaran') }}">
                                    @error('kembali_tabung')
                                        <span class="text-danger"> {{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Tambah Barang" />
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

<script>
    function updateTotal() {
        // mendapatkan elemen select barang dan input jumlah penebusan tabung
        var harga = document.querySelector('select[name="jual_tabung_id"] option:checked').getAttribute('data-harga');        
        var jumlah = document.getElementById('penebusan_tabung').value;
        // menghitung total berdasarkan harga dan jumlah penebusan tabung
        var total = harga * jumlah;
        // menampilkan total pada input total pembayaran
        document.getElementById('total_pembayaran').value = "Rp " + total.toLocaleString("id-ID");
        document.getElementById('total_pembayaran2').value = total;
    }

    function validateKembaliTabung() {
    var penebusanTabung = document.getElementById('penebusan_tabung').value;
    var kembaliTabung = document.getElementById('kembali_tabung').value;
    var errorElement = document.getElementById('kembali_tabung_error');
    
    if (kembaliTabung < penebusanTabung) {
        errorElement.innerHTML = 'Jumlah kembali tabung kurang dari jumlah penebusan tabung.';
    } else if (kembaliTabung > penebusanTabung) {
        errorElement.innerHTML = 'Jumlah kembali tabung lebih dari jumlah penebusan tabung.';
    } else {
        errorElement.innerHTML = '';
    }
}
</script>

@endsection