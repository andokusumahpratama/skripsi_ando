<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Hutang;
use App\Models\JualTabung;
use App\Models\Pangkalan;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $i = 1;        
        while ($i <= 5) {            
            $jual_tabung = JualTabung::select('id', 'harga_jual', 'barang_id')->inRandomOrder()->first();            

            $pangkalans = Pangkalan::findOrFail(24);
            $hutang = Hutang::where('barangss_id', $jual_tabung->barang_id)->where('pangkalan_id', $pangkalans->id)->first();

            $jml_penebusan_tabung = rand(1, 20);
            $jml_kembali_tabung = rand(round($jml_penebusan_tabung*0.7), $jml_penebusan_tabung);
            $kembali_tabung = $jml_penebusan_tabung - $jml_kembali_tabung;

            $total = $jml_penebusan_tabung * $jual_tabung->harga_jual;
            $bayar = rand(round($total*0.7), $total);
            $pembayaran = $total - $bayar;

            $minTimestamp = strtotime('2023-01-01');
            $maxTimestamp = time();
            $randomTimestamp = mt_rand($minTimestamp, $maxTimestamp);            

            Transaksi::create([
                'penebusan_tabung' => $jml_penebusan_tabung,
                'kembali_kabung' => $jml_kembali_tabung,
                'pembayaran' => $bayar,                
                'jual_tabung_id' => $jual_tabung->id,
                'pangkalan_id' => $pangkalans->id,
                'created_at' => Carbon::createFromTimestamp($randomTimestamp),
            ]);

            // If random tersebut menghasilkan hutang
            if($jml_kembali_tabung < $jml_penebusan_tabung || $pembayaran < $total){
                if ($hutang) {
                    $hutang->increment('hutang_tabung', $kembali_tabung);
                    $hutang->increment('hutang_pembelian', $pembayaran);
                    $hutang->touch(); // memperbarui updated_at
                }else{                                                          
                    Hutang::create([
                        'hutang_tabung' => $kembali_tabung,
                        'hutang_pembelian' => $pembayaran,
                        'barangss_id' => $jual_tabung->barang_id,
                        'pangkalan_id' => $pangkalans->id,
                        'created_at' => Carbon::createFromTimestamp($randomTimestamp),
                    ]);
                }
            }
            $i++;
        }
    }
}
