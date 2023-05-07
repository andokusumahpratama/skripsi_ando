<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\PangkalanController;
use App\Http\Controllers\pembelianTabungController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function(){

    // ! AKUN CONTROLLER
    Route::controller(AkunController::class)->group(function(){
        Route::get('/akun/logout/', 'logout')->name('akun.logout');
    
        Route::get('/karyawan/', 'karyawan')->name('karyawan.all');
        Route::get('/add/karyawan/', 'addKaryawan')->name('add.karyawan');
        Route::post('/store/karyawan/', 'storeKaryawan')->name('store.karyawan');
    
        Route::get('/edit/karyawan/{id}', 'editKaryawan')->name('edit.karyawan');
        Route::post('/update/karyawan/', 'updateKaryawan')->name('update.karyawan');
        Route::get('/delete/karyawan/{id}', 'deleteKaryawan')->name('delete.karyawan');
    
        Route::get('/change/password/', 'changePassword')->name('change.password');
        Route::post('/change/password/', 'updatePassword')->name('update.password');
    });
    
    // ! PANGKALAN CONTROLLER
    Route::controller(PangkalanController::class)->group(function(){
        Route::get('/pangkalan/', 'pangkalan')->name('pangkalan.all');
        Route::get('/add/pangkalan/', 'addPangkalan')->name('add.pangkalan');
        Route::post('/store/pangkalan/', 'storePangkalan')->name('store.pangkalan');
        
        Route::get('/edit/pangkalan/{id}', 'editPangkalan')->name('edit.pangkalan');
        Route::post('/update/pangkalan/', 'updatePangkalan')->name('update.pangkalan');
        Route::get('/delete/pangkalan/{id}', 'deletePangkalan')->name('delete.pangkalan');
    
        Route::get('/detail/pangkalan/{id}', 'detailPangkalan')->name('detail.pangkalan');    
        Route::get('/bayar/hutang/pangkalan/{id}', 'bayarPangkalan')->name('bayar.hutang.pangkalan');
        Route::post('/update/bayar/hutang/pangkalan/', 'updateBayarPangkalan')->name('update.bayar.pangkalan');
    
        Route::get('/riwayat/bayar/hutang/{pangakalan_id}', 'riwayatBayarHutang')->name('riwayat.bayar.hutang');
        Route::get('/delete/riwayat/hutang/{id}', 'hapusRiwayat')->name('delete.riwayat.hutang');
    
    });
    
    // ! BARANG CONTROLLER
    Route::controller(BarangController::class)->group(function(){
        Route::get('/barang/', 'barang')->name('barang.all');
        Route::get('/add/barang/', 'addBarang')->name('add.barang');
        Route::post('/store/barang/', 'storeBarang')->name('store.barang');
        
        Route::get('/edit/barang/{id}', 'editBarang')->name('edit.barang');
        Route::post('/update/barang/', 'updateBarang')->name('update.barang');
        Route::get('/delete/barang/{id}', 'deleteBarang')->name('delete.barang');
            
        Route::get('/add/harga/barang/', 'addHargaBarang')->name('add.harga.barang');
        Route::post('/store/harga/barang/', 'storeHargaBarang')->name('store.harga.barang');
        Route::get('/delete/harga/barang/{id}', 'deleteHargaBarang')->name('delete.harga.barang');
    });
    
    // ! STOK CONTROLLER
    Route::controller(StokBarangController::class)->group(function(){
        Route::get('/stok/barang', 'stokBarang')->name('stokBarang.all');
        Route::get('/add/stok/barang/', 'addStokBarang')->name('add.stok.barang');
        Route::post('/store/stok/barang/', 'storeStokBarang')->name('store.stok.barang');
        
        Route::get('/edit/stok/barang/{id}', 'editStokBarang')->name('edit.stok.barang');
        Route::post('/update/stok/barang/', 'updateStokBarang')->name('update.stok.barang');
        Route::get('/delete/stok/barang/{id}', 'deleteStokBarang')->name('delete.stok.barang');
    });
    
    // ! PEMBELIAN TABUNG CONTROLLER
    Route::controller(pembelianTabungController::class)->group(function(){
        Route::get('/daftar/pembelian/tabung/', 'orderTabung')->name('orderTabung.all');
        Route::post('/store/pembelian/tabung/', 'StorebeliTabung')->name('store.order.tabung');
        Route::post('/update/pembelian/tabung/{id}', 'updateOrder')->name('update.order.tabung');
        Route::get('/delete/pembelian/tabung/{id}', 'deletePembelianDO')->name('delete.order.tabung');
    });
    
    // ! TRANSAKSI
    Route::controller(TransaksiController::class)->group(function(){
        Route::get('/transaksi/', 'transaksi')->name('transaksi.all');
        Route::get('/add/transaksi/', 'addTransaksi')->name('add.transaksi');
        Route::post('/store/transaksi/', 'storeTransaksi')->name('store.transaksi');
        Route::get('/delete/transaksi/{id}', 'deleteTransaksi')->name('delete.transaksi');
        Route::post('/laporan/transaksi/', 'laporanTransaksi')->name('laporan.transaksi');
        Route::get('/laporan/transaksi/{id}', 'cetakNota')->name('cetak.nota');
    });
    
    // ! REPORT
    Route::controller(ReportController::class)->group(function(){
        Route::get('/reward/pangkalan/', 'rewardPangkalan')->name('reward.pangkalan');
        Route::post('/reward/pangkalan/', 'filterReward')->name('filter.reward');    
        // Route::get('/laporan/transaksi/', 'laporanTransaksi')->name('laporan.transaksi');
        Route::get('/download/pdf/report/', 'downloadPDF')->name('download.pdf.repord');
    });

    // ! DASHBOARD
    Route::controller(DasboardController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::post('/dashboard', 'filterDashboard')->name('filter.dashboard');
    });
});


// Route::get('/dashboard', [DasboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {    
//     return view('admin.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
