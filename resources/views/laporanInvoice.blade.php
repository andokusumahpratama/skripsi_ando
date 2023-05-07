<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: inherit;
}
html {
    font-size: 100%;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    font-weight: 300;
    color: #444;
    line-height: 1.9;
    /* background-color: #f3f3f3;     */
}
    /* CSS untuk container */
.container {
  width: 100%;  
  max-width: 700px;  
  margin: 0 auto;
  font-family: Arial, sans-serif;
  background-color: #fff;
  padding: 2rem;
  box-sizing: border-box;
  margin-top: 40px;
}

/* CSS untuk logo perusahaan */
.top{
    /* background: blue; */
}
.logo__perusahaan {
  display: flex;
  align-items: center;
  font-size: 28px;
  color: #555;
}
.logo__perusahaan img {
  max-height: 80px;
  margin-right: 20px;
}
.logo__text {
  display: inline-block;
  vertical-align: middle;
  margin-left: 10px; /* Sesuaikan margin kiri sesuai kebutuhan */
}

/* CSS untuk info pangkalan */
.mid{
  /* background: red;    */
  margin-top: 0px;
}
.info__pangkalan {
  font-size: 18px;
}
.alamat {
    /* font-weight: bold; */
    /* margin-top: 2px; */
    /* background: red; */
    max-width: 50%;
    line-height: 1.4;
    font-size: 14px;
    font-weight: 500;
}


/* CSS untuk info nota */
.info__nota {
  font-size: 17px;
  margin-top: 10px;
}
.no_nota,
.date {
  display: inline-block;
  margin-right: 20px;
}
.no_nota::before,
.date::before {
  content: '';
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-right: 5px;
  background: url('https://cdn3.iconfinder.com/data/icons/fugue/icon_shadowless/document.png') no-repeat;
  background-size: contain;
}

/* CSS untuk table */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}
table th,
table td {
  border: 1px solid #ddd;
  padding: 4px;
  text-align: center;
  font-weight: 0;
}
table th {
  background-color: #eee;
  font-weight: bold;
  text-align: center;
}
.table td:nth-child(4) {
  width: 100px;
}
.total-line {
  font-weight: bold;
}
.total-value {
  font-weight: bold;
  color: rgb(12, 6, 6);
  text-align: center;
}
.bg-success {
  background-color: #28a745;
}
.bg-danger {
  background-color: #df1809;
}
.text-white {
  color: #fff;
}

/* CSS untuk note dan tertanda */
.note {
  margin-top: 20px;
  font-size: 15px;
}
.tertanda {
  margin-top: 40px;
  text-align: right;
  font-size: 18px;
}
.tertanda b {
  display: block;
  font-weight: bold;
  margin-top: 10px;
}
</style>
<body>
    <div class="page-content">
        <div class="container-fluid">
    <div class="container">
        <div class="top">
            <div class="logo__perusahaan">
                {{-- <img src="{{public_path('upload/banteng.png')}}" alt="">                   --}}
                <img src="{{public_path('upload/banteng.png')}}" alt="">    
                <div class="logo__text">PT. Azaria Bangun Energi</div>                
            </div>            
        </div>
        <div class="mid">
            <div class="info__pangkalan">
                <h3>{{$nama_pangkalan}}</h3>
                <div class="alamat">{{$alamat}}</div>                
            </div>
            <div class="info__nota">
                <div class="no_nota">No Nota: 1921201</div>
                <div class="date">{{ date('Y-m-d', strtotime('+1 day')) }}</div>
            </div>            
        </div>
        <div id="table__area">
            <table class="table">
                @php
                  $i = 1;
                  $grandTotal = 0;
                  $grandPembayaran = 0;
                @endphp
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Qty Isi</th>
                    <th>Qty Kosong</th>
                    <th>Harga</th>
                    <th>TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  @if ($cek == 0)
                  @php                      
                      $JualTabung = App\Models\JualTabung::findOrFail($transaksis->jual_tabung_id);
                      $barang = App\Models\Barang::findOrFail($JualTabung->barangt_id);
                      $total = $JualTabung->harga_jual * $transaksis->penebusan_tabung;
                      $grandTotal += $total;
                      $grandPembayaran += $transaksis->pembayaran;
                  @endphp
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ ucfirst($barang->nama_barang) }}</td>
                        <td>{{ $transaksis->penebusan_tabung }}</td>
                        <td>{{ $transaksis->kembali_kabung }}</td>
                        <td>Rp. {{ number_format($JualTabung->harga_jual, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                  @else

                  @foreach ($transaksis as $item)
                      @php                      
                          $JualTabung = App\Models\JualTabung::findOrFail($item->jual_tabung_id);
                          $barang = App\Models\Barang::findOrFail($JualTabung->barangt_id);
                          $total = $JualTabung->harga_jual * $item->penebusan_tabung;
                          $grandTotal += $total;
                          $grandPembayaran += $item->pembayaran;
                      @endphp
                      <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $barang->nama_barang }}</td>
                          <td>{{ $item->penebusan_tabung }}</td>
                          <td>{{ $item->kembali_kabung }}</td>
                          <td>Rp. {{ number_format($JualTabung->harga_jual, 0, ',', '.') }}</td>
                          <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                      </tr>
                  @endforeach

                  @endif
                  <tr>
                      <td colspan="3" style="border-left: 3px solid white;border-bottom: 3px solid white;"></td>
                      <td colspan="2" class="total-line" style="text-align: left;">Total</td>
                      <td class="total-value">Rp. {{ number_format($grandTotal, 0, ',', '.') }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="border-left: 3px solid white;border-bottom: 3px solid white;"></td>
                    <td colspan="2" class="total-line" style="text-align: left;">Pembayaran</td>
                    <td class="total-value">Rp. {{ number_format($grandPembayaran, 0, ',', '.') }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="border-left: 3px solid white;border-bottom: 3px solid white;"></td>
                    <td colspan="2" class="total-line" style="text-align: left;">Status</td>
                    @if ($grandTotal > $grandPembayaran)                        
                      <td class="total-value bg-danger text-white font-weight-light" >Belum Lunas</td>
                    @else
                      <td class="total-value bg-success text-white font-weight-light" >Lunas</td>
                    @endif
                  </tr>
                </tbody>
              </table>  
        </div>

        <div class="down">
            <div class="note">
                <p>         
                  @if ($grandTotal > $grandPembayaran)                        
                  <b>Note: </b>
                  Pembayaran kurang Rp {{ number_format($grandTotal-$grandPembayaran, 0, ',', '.') }}
                  @else
                  <b>Note: </b>
                  Terima Kasih Sudah Membeli Gas Di Kami.
                  @endif                             
                </p>
            </div>
            <div class="tertanda">
                <i>Tertanda Karyawan<b>Ando Kusumah</b></i>
            </div>
        </div>
    </div>
    </div>
    
</div>
</body>
</html>