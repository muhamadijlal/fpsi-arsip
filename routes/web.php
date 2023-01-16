<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dosen\PenelitianController;
use App\Http\Controllers\Dosen\PengabdianController;
use App\Http\Controllers\Dosen\PenunjangController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
  'middleware' => [
    'revalidate',
    'root'
  ],
  'prefix' => 'root',
  'as' => 'root.'
], function(){
  Route::get('dashboard', [DashboardController::class, 'dashboardRoot'])->name('dashboard');

  Route::group([
    'prefix' => 'jurnal',
    'namespace' => 'App\Http\Controllers\Root',
    'controller' => JurnalController::class,
  ], function(){
    Route::get('/','jurnal')->name('jurnal');
    Route::get('/create','jurnal_create')->name('jurnal_create');
    Route::get('/dataTable', 'dataTable_jurnal')->name('dataTable.jurnal');
    Route::post('/store','jurnal_store')->name('jurnal_store');
    Route::get('/edit/{id}','jurnal_edit')->name('jurnal_edit');
    Route::put('/update/{id}','jurnal_update')->name('jurnal_update');
    Route::get('/delete/{id}','jurnal_destroy')->name('jurnal_destroy');
    Route::get('/history/{id}','jurnal_history')->name('jurnal_history');
    Route::get('/history/add/{id}','jurnal_history_create')->name('jurnal_history_create');
    Route::post('/history/store/{id}','jurnal_history_store')->name('jurnal_history_store');
  });

  // pendidikan root
  Route::group([
    'prefix' => 'pendidikan',
    'namespace' => 'App\Http\Controllers\Root',
    'controller' => PendidikanController::class
  ], function(){

    Route::get('/', 'index')->name('pendidikan');
  
    // pendidikan // Sk pembimbing
    Route::get('/pembimbing', 'pembimbing')->name('pembimbing');
    Route::get('/pembimbing/dataTable', 'dataTable_pembimbing')->name('dataTable.pembimbing');
    Route::get('/pembimbing/add', 'pembimbing_create')->name('pembimbing_create');
    Route::post('/pembimbing/store', 'pembimbing_store');
    Route::get('/pembimbing/edit/{id}', 'pembimbing_edit')->name('pembimbing_edit');
    Route::put('/pembimbing/update/{id}', 'pembimbing_update');
    Route::get('/pembimbing/delete/{id}', 'pembimbing_destroy');

    // pendidikan // Sk penetapan jadwal kuliah
    Route::get('/jadwal_kuliah', 'jadwal_kuliah')->name('jadwal_kuliah');
    Route::get('/jadwal_kuliah/dataTable', 'dataTable_jadwal_kuliah')->name('dataTable.jadwal_kuliah');
    Route::get('/jadwal_kuliah/add', 'jadwal_kuliah_create')->name('jadwal_kuliah_create');
    Route::post('/jadwal_kuliah/store', 'jadwal_kuliah_store');
    Route::get('/jadwal_kuliah/edit/{id}', 'jadwal_kuliah_edit')->name('jadwal_kuliah_edit');
    Route::put('/jadwal_kuliah/update/{id}', 'jadwal_kuliah_update');
    Route::get('/jadwal_kuliah/delete/{id}', 'jadwal_kuliah_destroy');

    // pendidikan // Sk yudisium
    Route::get('/yudisium', 'yudisium')->name('yudisium');
    Route::get('/yudisium/dataTable', 'dataTable_yudisium')->name('dataTable.yudisium');
    Route::get('/yudisium/add', 'yudisium_create')->name('yudisium_create');
    Route::post('/yudisium/store', 'yudisium_store');
    Route::get('/yudisium/edit/{id}', 'yudisium_edit')->name('yudisium_edit');
    Route::put('/yudisium/update/{id}', 'yudisium_update');
    Route::get('/yudisium/delete/{id}', 'yudisium_destroy');

    // pendidikan // Sk Koordinator dan Prodi
    Route::get('/koorprodi', 'koorprodi')->name('koorprodi');
    Route::get('/koorprodi/dataTable', 'dataTable_koorprodi')->name('dataTable.koorprodi');
    Route::get('/koorprodi/add', 'koorprodi_create')->name('koorprodi_create');
    Route::post('/koorprodi/store', 'koorprodi_store');
    Route::get('/koorprodi/edit/{id}', 'koorprodi_edit')->name('koorprodi_edit');
    Route::put('/koorprodi/update/{id}', 'koorprodi_update');
    Route::get('/koorprodi/delete/{id}', 'koorprodi_destroy');

    // pendidikan // Sk Lainnya
    Route::get('/lainnya', 'lainnya')->name('lainnya');
    Route::get('/lainnya/dataTable', 'dataTable_lainnya')->name('dataTable.lainnya');
    Route::get('/lainnya/add', 'lainnya_create')->name('lainnya_create');
    Route::post('/lainnya/store', 'lainnya_store');
    Route::get('/lainnya/edit/{id}', 'lainnya_edit')->name('lainnya_edit');
    Route::put('/lainnya/update/{id}', 'lainnya_update');
    Route::get('/lainnya/delete/{id}', 'lainnya_destroy');
  });
});

Route::group([
  'middleware' => [
    'revalidate',
    'kepala'
  ],
  'prefix' => 'kepala',
  'as' => 'kepala.'
], function(){
  Route::get('dashboard', [DashboardController::class, 'dashboardKepala'])->name('dashboard');

  Route::group([
    'prefix' => 'jurnal',
    'namespace' => 'App\Http\Controllers\Kepala',
    'controller' => JurnalController::class,
  ], function(){
    Route::get('/','jurnal')->name('jurnal');
    Route::get('/create','jurnal_create')->name('jurnal_create');
    Route::get('/dataTable', 'dataTable_jurnal')->name('dataTable.jurnal');
    Route::post('/store','jurnal_store')->name('jurnal_store');
    Route::get('/edit/{id}','jurnal_edit')->name('jurnal_edit');
    Route::put('/update/{id}','jurnal_update')->name('jurnal_update');
    Route::get('/delete/{id}','jurnal_destroy')->name('jurnal_destroy');
    Route::get('/history/{id}','jurnal_history')->name('jurnal_history');
    Route::get('/history/add/{id}','jurnal_history_create')->name('jurnal_history_create');
    Route::post('/history/store/{id}','jurnal_history_store')->name('jurnal_history_store');
  });
});

Route::group([
  'prefix' => 'dosen', 
  'as' => 'dosen.',
  'middleware' => [
    'revalidate',
    'dosen']
  ], function(){
  Route::get('/dashboard', [DashboardController::class, 'dashboardDosen'])->name('dashboard');

  // pendidikan
  Route::group([
    'prefix' => 'pendidikan',
    'namespace' => 'App\Http\Controllers\Dosen',
    'controller' => PendidikanController::class
  ], function(){

    Route::get('/', 'index')->name('pendidikan');
  
    // pendidikan // Sk pembimbing
    Route::get('/pembimbing', 'pembimbing')->name('pembimbing');
    Route::get('/pembimbing/dataTable', 'dataTable_pembimbing')->name('dataTable.pembimbing');
    Route::get('/pembimbing/add', 'pembimbing_create')->name('pembimbing_create');
    Route::post('/pembimbing/store', 'pembimbing_store');
    Route::get('/pembimbing/edit/{id}', 'pembimbing_edit')->name('pembimbing_edit');
    Route::put('/pembimbing/update/{id}', 'pembimbing_update');
    Route::get('/pembimbing/delete/{id}', 'pembimbing_destroy');

    // pendidikan // Sk penetapan jadwal kuliah
    Route::get('/jadwal_kuliah', 'jadwal_kuliah')->name('jadwal_kuliah');
    Route::get('/jadwal_kuliah/dataTable', 'dataTable_jadwal_kuliah')->name('dataTable.jadwal_kuliah');
    Route::get('/jadwal_kuliah/add', 'jadwal_kuliah_create')->name('jadwal_kuliah_create');
    Route::post('/jadwal_kuliah/store', 'jadwal_kuliah_store');
    Route::get('/jadwal_kuliah/edit/{id}', 'jadwal_kuliah_edit')->name('jadwal_kuliah_edit');
    Route::put('/jadwal_kuliah/update/{id}', 'jadwal_kuliah_update');
    Route::get('/jadwal_kuliah/delete/{id}', 'jadwal_kuliah_destroy');

    // pendidikan // Sk yudisium
    Route::get('/yudisium', 'yudisium')->name('yudisium');
    Route::get('/yudisium/dataTable', 'dataTable_yudisium')->name('dataTable.yudisium');
    Route::get('/yudisium/add', 'yudisium_create')->name('yudisium_create');
    Route::post('/yudisium/store', 'yudisium_store');
    Route::get('/yudisium/edit/{id}', 'yudisium_edit')->name('yudisium_edit');
    Route::put('/yudisium/update/{id}', 'yudisium_update');
    Route::get('/yudisium/delete/{id}', 'yudisium_destroy');

    // pendidikan // Sk Koordinator dan Prodi
    Route::get('/koorprodi', 'koorprodi')->name('koorprodi');
    Route::get('/koorprodi/dataTable', 'dataTable_koorprodi')->name('dataTable.koorprodi');
    Route::get('/koorprodi/add', 'koorprodi_create')->name('koorprodi_create');
    Route::post('/koorprodi/store', 'koorprodi_store');
    Route::get('/koorprodi/edit/{id}', 'koorprodi_edit')->name('koorprodi_edit');
    Route::put('/koorprodi/update/{id}', 'koorprodi_update');
    Route::get('/koorprodi/delete/{id}', 'koorprodi_destroy');

    // pendidikan // Sk Lainnya
    Route::get('/lainnya', 'lainnya')->name('lainnya');
    Route::get('/lainnya/dataTable', 'dataTable_lainnya')->name('dataTable.lainnya');
    Route::get('/lainnya/add', 'lainnya_create')->name('lainnya_create');
    Route::post('/lainnya/store', 'lainnya_store');
    Route::get('/lainnya/edit/{id}', 'lainnya_edit')->name('lainnya_edit');
    Route::put('/lainnya/update/{id}', 'lainnya_update');
    Route::get('/lainnya/delete/{id}', 'lainnya_destroy');
  });

  // penelitian
  Route::group([
    'prefix' => 'penelitian',
    'controller' => PenelitianController::class,
  ], function(){

    Route::get('/', 'index')->name('penelitian');

    // penelitian //Jurnal Penelitian / Prosiding
    Route::get('jurnal/prosiding', 'jurnal_pelpro')->name('pelpro');
    Route::get('jurnal/prosiding/dataTable', 'dataTable_jurnal_pelpro')->name('dataTable.jurnal_pelpro');
    Route::get('jurnal/prosiding/add', 'jurnal_pelpro_create')->name('pelpro_create');
    Route::post('jurnal/prosiding/store', 'jurnal_pelpro_store');
    Route::get('jurnal/prosiding/edit/{id}', 'jurnal_pelpro_edit')->name('pelpro_edit');
    Route::put('jurnal/prosiding/update/{id}', 'jurnal_pelpro_update');
    Route::get('jurnal/prosiding/delete/{id}', 'jurnal_pelpro_destroy');

    // penelitian //Surat Penelitian
    Route::get('surat', 'surat_penelitian')->name('surat');
    Route::get('surat/dataTable', 'dataTable_surat_penelitian')->name('dataTable.surat_penelitian');
    Route::get('surat/add', 'surat_penelitian_create')->name('surat_create');
    Route::post('surat/store', 'surat_penelitian_store');
    Route::get('surat/edit/{id}', 'surat_penelitian_edit')->name('surat_edit');
    Route::put('surat/update/{id}', 'surat_penelitian_update');
    Route::get('surat/delete/{id}', 'surat_penelitian_destroy');

    // penelitian //Laporan dan Artikel Penelitian
    Route::get('laporan/artikel', 'laporan_artikel_penelitian')->name('laporanArtikel');
    Route::get('laporan/artikel/dataTable', 'dataTable_laporan_artikel_penelitian')->name('dataTable.laporan_artikel_penelitian');
    Route::get('laporan/artikel/add', 'laporan_artikel_penelitian_create')->name('laporanArtikel_create');;
    Route::post('laporan/artikel/store', 'laporan_artikel_penelitian_store');
    Route::get('laporan/artikel/edit/{id}', 'laporan_artikel_penelitian_edit')->name('laporanArtikel_edit');;
    Route::put('laporan/artikel/update/{id}', 'laporan_artikel_penelitian_update');
    Route::get('laporan/artikel/delete/{id}', 'laporan_artikel_penelitian_destroy');

    // penelitian //Surat Tugas Penelitian
    Route::get('surat/tugas', 'surat_tugas_penelitian')->name('suratTugas');
    Route::get('surat/tugas/dataTable', 'dataTable_surat_tugas_penelitian')->name('dataTable.surat_tugas_penelitian');
    Route::get('surat/tugas/add', 'surat_tugas_penelitian_create')->name('suratTugas_create');
    Route::post('surat/tugas/store', 'surat_tugas_penelitian_store');
    Route::get('surat/tugas/edit/{id}', 'surat_tugas_penelitian_edit')->name('suratTugas_edit');
    Route::put('surat/tugas/update/{id}', 'surat_tugas_penelitian_update');
    Route::get('surat/tugas/delete/{id}', 'surat_tugas_penelitian_destroy');
  });

  // Pengabdian
  Route::group([
    'prefix' => 'pengabdian',
    'controller' => PengabdianController::class,
  ], function() {

    Route::get('/', 'index')->name('pengabdian');

    // Pengabdian // Laporan dan Artikel Pengabdian
    Route::get('laporan/artikel', 'laporan_artikel_pengabdian')->name('laporan_artikel_pengabdian');
    Route::get('laporan/artikel/dataTable', 'dataTable_laporan_artikel_pengabdian')->name('dataTable.laporan_artikel_pengabdian');
    Route::get('laporan/artikel/add', 'laporan_artikel_pengabdian_create')->name('laporan_artikel_pengabdian_create');;
    Route::post('laporan/artikel/store', 'laporan_artikel_pengabdian_store')->name('laporan_artikel_pengabdian_edit');;
    Route::get('laporan/artikel/edit/{id}', 'laporan_artikel_pengabdian_edit');
    Route::put('laporan/artikel/update/{id}', 'laporan_artikel_pengabdian_update');
    Route::get('laporan/artikel/delete/{id}', 'laporan_artikel_pengabdian_destroy');

    // Pengabdian // Laporan Tanpa Prosiding
    Route::get('laporan/tanpa/prosiding/', 'laporan_tanpa_prosiding')->name('laporan_tanpa_prosiding');
    Route::get('laporan/tanpa/prosiding/dataTable', 'dataTable_laporan_tanpa_prosiding')->name('dataTable.laporan_tanpa_prosiding');
    Route::get('laporan/tanpa/prosiding/add', 'laporan_tanpa_prosiding_create')->name('laporan_tanpa_prosiding_create');
    Route::post('laporan/tanpa/prosiding/store', 'laporan_tanpa_prosiding_store');
    Route::get('laporan/tanpa/prosiding/edit/{id}', 'laporan_tanpa_prosiding_edit')->name('laporan_tanpa_prosiding_edit');
    Route::put('laporan/tanpa/prosiding/update/{id}', 'laporan_tanpa_prosiding_update');
    Route::get('laporan/tanpa/prosiding/delete/{id}', 'laporan_tanpa_prosiding_destroy');

  });

  // penunjang
  Route::group([
    'prefix' => 'penunjang',
  ], function (){

    Route::group([
      'controller' => PenunjangController::class
    ], function(){

      Route::get('/', 'index')->name('penunjang');

      // Penunjang // Sertifikat
      Route::get('sertifikat/', 'sertifikat')->name('sertifikat');
      Route::get('sertifikat/dataTable', 'dataTable_sertifikat')->name('dataTable.sertifikat');
      Route::get('sertifikat/add', 'sertifikat_create')->name('sertifikat_create');
      Route::post('sertifikat/store', 'sertifikat_store');
      Route::get('sertifikat/edit/{id}', 'sertifikat_edit')->name('sertifikat_edit');
      Route::put('sertifikat/update/{id}', 'sertifikat_update');
      Route::get('sertifikat/delete/{id}', 'sertifikat_destroy');

    });

    Route::group([
      'namespace' => 'App\Http\Controllers\Dosen',
      'controller' => DTController::class
    ], function(){
      // Penunjang // Surat Kunjungan Dosen Tamu
      Route::get('dosen/tamu', 'dosen_tamu')->name('dosen_tamu');
      Route::get('dosen/tamu/dataTable', 'dataTable_dosen_tamu')->name('dataTable.dosen_tamu');
      Route::get('dosen/tamu/add', 'dosen_tamu_create')->name('dosen_tamu_create');
      Route::post('dosen/tamu/store', 'dosen_tamu_store')->name('dosen_tamu_store');
      Route::get('dosen/tamu/edit/{id}', 'dosen_tamu_edit')->name('dosen_tamu_edit');
      Route::put('dosen/tamu/update/{id}', 'dosen_tamu_update')->name('dosen_tamu_update');
      Route::get('dosen/tamu/delete/{id}', 'dosen_tamu_destroy')->name('dosen_tamu_destroy');
    });

    Route::group([
      'namespace' => 'App\Http\Controllers\Dosen',
      'controller' => KonselingController::class,
    ], function(){
      // Penunjang Konseling
      Route::get('konseling', 'konseling')->name('konseling');
      Route::get('konseling/dataTable', 'dataTable_konseling')->name('dataTable.konseling');
      Route::get('konseling/add', 'konseling_create')->name('konseling_create');
      Route::post('konseling/store', 'konseling_store')->name('konseling_store');
      Route::get('konseling/edit/{id}', 'konseling_edit')->name('konseling_edit');
      Route::put('konseling/update/{id}', 'konseling_update')->name('konseling_update');
      Route::get('konseling/delete/{id}', 'konseling_destroy')->name('konseling_destroy');
    });

  });

});

// Tata usaha Route
Route::group(['prefix' => 'tu', 'as' => 'tu.','middleware' => ['revalidate','tu']], function(){

  Route::get('dashboard', [DashboardController::class, 'dashboardTU'])->name('dashboard');

  Route::group([
    'namespace' => '\App\Http\controllers\TU',
    'controller' => ArsipController::class,
  ], function(){
    // Arsip TU
    Route::get('arsip/','arsip')->name('arsip');
    Route::get('arsip/dataTable', 'dataTable_arsip')->name('dataTable.arsip');
    Route::get('arsip/add','arsip_create')->name('arsip_create');
    Route::post('arsip/store','arsip_store')->name('arsip_store');
    Route::get('arsip/edit/{id}','arsip_edit')->name('arsip_edit');
    Route::put('arsip/update/{id}','arsip_update')->name('arsip_update');
    Route::get('arsip/delete/{id}','arsip_destroy')->name('arsip_destroy');
  });

  // Dosen Tamu
  Route::group([
    'namespace' => 'App\Http\Controllers\TU',
    'controller' => DTController::class,
  ], function(){
    Route::get('dosen/tamu', 'dosen_tamu')->name('dosen_tamu');
    Route::get('dosen/tamu/dataTable', 'dataTable_dosen_tamu')->name('dataTable.dosen_tamu');
    Route::get('dosen/tamu/add', 'dosen_tamu_create')->name('dosen_tamu_create');
    Route::post('dosen/tamu/store', 'dosen_tamu_store')->name('dosen_tamu_store');
    Route::get('dosen/tamu/edit/{id}', 'dosen_tamu_edit')->name('dosen_tamu_edit');
    Route::put('dosen/tamu/update/{id}', 'dosen_tamu_update')->name('dosen_tamu_update');
    Route::get('dosen/tamu/delete/{id}', 'dosen_tamu_destroy')->name('dosen_tamu_destroy');
    Route::get('dosen/tamu/print/{id}', 'dosen_tamu_print')->name('dosen_tamu_print');
  });

  // Konseling
  Route::group([
    'namespace' => 'App\Http\Controllers\TU',
    'controller' => KonselingController::class,
  ], function(){
    Route::get('konseling', 'konseling')->name('konseling');
    Route::get('konseling/dataTable', 'dataTable_konseling')->name('dataTable.konseling');
    Route::get('konseling/add', 'konseling_create')->name('konseling_create');
    Route::post('konseling/store', 'konseling_store')->name('konseling_store');
    Route::get('konseling/edit/{id}', 'konseling_edit')->name('konseling_edit');
    Route::put('konseling/update/{id}', 'konseling_update')->name('konseling_update');
    Route::get('konseling/delete/{id}', 'konseling_destroy')->name('konseling_destroy');
  });

  // Legalisasi Ijazah
  Route::group([
    'namespace' => 'App\Http\Controllers\TU',
    'controller' => LegalisasiController::class,
  ], function(){
    Route::get('legalisasi/ijazah', 'legalisasi')->name('legalisasi');
    Route::get('legalisasi/ijazah/dataTable', 'dataTable_legalisasi')->name('dataTable.legalisasi');
    Route::get('legalisasi/ijazah/edit/{id}', 'legalisasi_edit')->name('legalisasi_edit');
    Route::put('legalisasi/ijazah/update/{id}', 'legalisasi_update')->name('legalisasi_update');
    Route::get('legalisasi/ijazah/delete/{id}', 'legalisasi_destroy')->name('legalisasi_destroy');
    Route::get('legalisasi/ijazah/print', 'legalisasi_print')->name('legalisasi_print');
  });

  // Kerja Praktik
  Route::group([
    'namespace' => 'App\Http\Controllers\TU',
    'controller' => KPController::class,
    'prefix' => 'kerja/praktik'
  ], function(){

    Route::get('/','index')->name('kerja_praktik');

    Route::group([
      'prefix' => 'umum',
      'as' => 'umum_',
    ], function(){
      Route::get('/', 'kerja_praktik_umum')->name('kerja_praktik');
      Route::get('/dataTable', 'kerja_praktik_dataTable_umum')->name('dataTable.kerja_praktik');
      Route::get('/add', 'kerja_praktik_umum_create')->name('kerja_praktik_create');
      Route::post('/store', 'kerja_praktik_umum_store')->name('kerja_praktik_store');
      Route::get('/edit/{id}', 'kerja_praktik_umum_edit')->name('kerja_praktik_edit');
      Route::put('/update/{id}', 'kerja_praktik_umum_update')->name('kerja_praktik_update');
      Route::get('/delete/{id}', 'kerja_praktik_umum_destroy')->name('kerja_praktik_destroy');
      Route::get('/print/{id}', 'kerja_praktik_umum_print')->name('kerja_praktik_print');
    });

    Route::group([
      'prefix' => 'dinas',
      'as' => 'dinas_',
    ], function(){
      Route::get('/', 'kerja_praktik_dinas')->name('kerja_praktik');
      Route::get('/dataTable', 'kerja_praktik_dataTable_dinas')->name('dataTable.kerja_praktik');
      Route::get('/add', 'kerja_praktik_dinas_create')->name('kerja_praktik_create');
      Route::post('/store', 'kerja_praktik_dinas_store')->name('kerja_praktik_store');
      Route::get('/edit/{id}', 'kerja_praktik_dinas_edit')->name('kerja_praktik_edit');
      Route::put('/update/{id}', 'kerja_praktik_dinas_update')->name('kerja_praktik_update');
      Route::get('/delete/{id}', 'kerja_praktik_dinas_destroy')->name('kerja_praktik_destroy');
      Route::get('/print/{id}', 'kerja_praktik_dinas_print')->name('kerja_praktik_print');
    });
  });

  // Aktif Kuliah
  Route::group([
    'namespace' => 'App\Http\Controllers\TU',
    'controller' => AktifKuliahController::class,
    'prefix' => 'aktif/kuliah',
  ], function(){

    Route::get('/', 'index')->name('aktif_kuliah');

    Route::group([
      'prefix' => 'umum',
      'as' => 'umum_',
    ], function(){
      Route::get('/','aktif_kuliah_umum')->name('aktif_kuliah');
      Route::get('/dataTable','aktif_kuliah_dataTable_umum')->name('dataTable.aktif_kuliah');
      Route::get('/add','aktif_kuliah_umum_create')->name('aktif_kuliah_create');
      Route::post('/store','aktif_kuliah_umum_store')->name('aktif_kuliah_store');
      Route::get('/edit/{id}','aktif_kuliah_umum_edit')->name('aktif_kuliah_edit');
      Route::put('/update/{id}','aktif_kuliah_umum_update')->name('aktif_kuliah_update');
      Route::get('/delete/{id}','aktif_kuliah_umum_destroy')->name('aktif_kuliah_destroy');
      Route::get('/print/{id}','aktif_kuliah_umum_print')->name('aktif_kuliah_print');
    });

    Route::group([
      'prefix' => 'dinas',
      'as' => 'dinas_',
    ], function(){
      Route::get('/','aktif_kuliah_dinas')->name('aktif_kuliah');
      Route::get('/dataTable','aktif_kuliah_dataTable_dinas')->name('dataTable.aktif_kuliah');
      Route::get('/add','aktif_kuliah_dinas_create')->name('aktif_kuliah_create');
      Route::post('/store','aktif_kuliah_dinas_store')->name('aktif_kuliah_store');
      Route::get('/edit/{id}','aktif_kuliah_dinas_edit')->name('aktif_kuliah_edit');
      Route::put('/update/{id}','aktif_kuliah_dinas_update')->name('aktif_kuliah_update');
      Route::get('/delete/{id}','aktif_kuliah_dinas_destroy')->name('aktif_kuliah_destroy');
      Route::get('/print/{id}','aktif_kuliah_dinas_print')->name('aktif_kuliah_print');
    });
  }); 

  // Observasi 
  Route::group([
    'prefix' => 'observasi',
    'namespace' => 'App\Http\Controllers\TU',
    'controller' => ObservasiController::class
  ], function(){
    Route::get('/','observasi')->name('observasi');
    Route::get('/dataTable','observasi_dataTable')->name('dataTable.observasi');
    Route::get('/add','observasi_create')->name('observasi_create');
    Route::post('/store','observasi_store')->name('observasi_store');
    Route::get('/edit/{id}','observasi_edit')->name('observasi_edit');
    Route::put('/update/{id}','observasi_update')->name('observasi_update');
    Route::get('/delete/{id}','observasi_destroy')->name('observasi_destroy');
    Route::get('/print/{id}','observasi_print')->name('observasi_print');
    Route::group([
      'prefix' => 'anggota',
      'as' => 'anggota.'
    ], function(){
      Route::get('/{id}/add','anggota_observasi_create')->name('observasi_create');
      Route::post('/{id}/store','anggota_observasi_store')->name('observasi_store');
      Route::get('/{id}/delete','anggota_observasi_destroy')->name('observasi_destroy');
    });
  });

  // Observasi kelompok
  Route::group([
    'prefix' => 'observasi_kelompok',
    'namespace' => 'App\Http\Controllers\TU',
    'controller' => ObservasiKelompokController::class
  ], function(){
    Route::get('/','observasi_kelompok')->name('observasi_kelompok');
    Route::get('/dataTable','observasi_kelompok_dataTable')->name('dataTable.observasi_kelompok');
    Route::get('/add','observasi_kelompok_create')->name('observasi_kelompok_create');
    Route::post('/store','observasi_kelompok_store')->name('observasi_kelompok_store');
    Route::get('/edit/{id}','observasi_kelompok_edit')->name('observasi_kelompok_edit');
    Route::put('/update/{id}','observasi_kelompok_update')->name('observasi_kelompok_update');
    Route::get('/delete/{id}','observasi_kelompok_destroy')->name('observasi_kelompok_destroy');
    Route::get('/print/{id}','observasi_kelompok_print')->name('observasi_kelompok_print');
    Route::group([
      'prefix' => 'anggota',
      'as' => 'anggota.'
    ], function(){
      Route::get('/{id}/add','anggota_observasi_kelompok_create')->name('observasi_kelompok_create');
      Route::post('/{id}/store','anggota_observasi_kelompok_store')->name('observasi_kelompok_store');
      Route::get('/{id}/delete','anggota_observasi_kelompok_destroy')->name('observasi_kelompok_destroy');
    });
  });

  // Surat Izin
  Route::group([
    'prefix' => 'surat/izin',
    'namespace' => 'App\Http\Controllers\TU',
    'controller' => SuratIzinController::class
  ], function(){
    Route::get('/','surat_izin')->name('surat_izin');
    Route::get('/dataTable','surat_izin_dataTable')->name('dataTable.surat_izin');
    Route::get('/add','surat_izin_create')->name('surat_izin_create');
    Route::post('/store','surat_izin_store')->name('surat_izin_store');
    Route::get('/edit/{id}','surat_izin_edit')->name('surat_izin_edit');
    Route::put('/update/{id}','surat_izin_update')->name('surat_izin_update');
    Route::get('/delete/{id}','surat_izin_destroy')->name('surat_izin_destroy');
    Route::get('/print/{id}','surat_izin_print')->name('surat_izin_print');
  });
});

Route::group([ 'prefix' => 'mahasiswa', 'as' => 'mahasiswa.', 'middleware' => ['revalidate','mahasiswa']], function(){

  Route::get('dashboard', [DashboardController::class, 'dashboardMahasiswa'])->name('dashboard');

  // Legalisasi Ijazah
  Route::group([
    'namespace' => 'App\Http\Controllers\Mahasiswa',
    'controller' => LegalisasiController::class,
  ], function(){
    Route::get('legalisasi/ijazah', 'legalisasi')->name('legalisasi');
    Route::get('legalisasi/ijazah/add', 'legalisasi_create')->name('legalisasi_create');
    Route::post('legalisasi/ijazah/store', 'legalisasi_store')->name('legalisasi_store');
    Route::get('legalisasi/ijazah/dataTable', 'dataTable_legalisasi')->name('dataTable.legalisasi');
    Route::get('legalisasi/ijazah/edit/{id}', 'legalisasi_edit')->name('legalisasi_edit');
    Route::put('legalisasi/ijazah/update/{id}', 'legalisasi_update')->name('legalisasi_update');
  });

  // Kerja Praktik
  Route::group([
    'namespace' => 'App\Http\Controllers\Mahasiswa',
    'controller' => KPController::class,
    'prefix' => 'kerja/praktik'
  ], function(){

    Route::get('/','index')->name('kerja_praktik');

    Route::group([
      'prefix' => 'umum',
      'as' => 'umum_',
    ], function(){
      Route::get('/', 'kerja_praktik_umum')->name('kerja_praktik');
      Route::get('/dataTable', 'kerja_praktik_dataTable_umum')->name('dataTable.kerja_praktik');
      Route::get('/add', 'kerja_praktik_umum_create')->name('kerja_praktik_create');
      Route::post('/store', 'kerja_praktik_umum_store')->name('kerja_praktik_store');
      Route::get('/edit/{id}', 'kerja_praktik_umum_edit')->name('kerja_praktik_edit');
      Route::put('/update/{id}', 'kerja_praktik_umum_update')->name('kerja_praktik_update');
    });

    Route::group([
      'prefix' => 'dinas',
      'as' => 'dinas_',
    ], function(){
      Route::get('/', 'kerja_praktik_dinas')->name('kerja_praktik');
      Route::get('/dataTable', 'kerja_praktik_dataTable_dinas')->name('dataTable.kerja_praktik');
      Route::get('/add', 'kerja_praktik_dinas_create')->name('kerja_praktik_create');
      Route::post('/store', 'kerja_praktik_dinas_store')->name('kerja_praktik_store');
      Route::get('/edit/{id}', 'kerja_praktik_dinas_edit')->name('kerja_praktik_edit');
      Route::put('/update/{id}', 'kerja_praktik_dinas_update')->name('kerja_praktik_update');
    });
  });

  // Aktif Kuliah
  Route::group([
    'namespace' => 'App\Http\Controllers\Mahasiswa',
    'controller' => AktifKuliahController::class,
    'prefix' => 'aktif/kuliah',
  ], function(){

    Route::get('/', 'index')->name('aktif_kuliah');

    Route::group([
      'prefix' => 'umum',
      'as' => 'umum_',
    ], function(){
      Route::get('/','aktif_kuliah_umum')->name('aktif_kuliah');
      Route::get('/dataTable','aktif_kuliah_dataTable_umum')->name('dataTable.aktif_kuliah');
      Route::get('/add','aktif_kuliah_umum_create')->name('aktif_kuliah_create');
      Route::post('/store','aktif_kuliah_umum_store')->name('aktif_kuliah_store');
      Route::get('/edit/{id}','aktif_kuliah_umum_edit')->name('aktif_kuliah_edit');
      Route::put('/update/{id}','aktif_kuliah_umum_update')->name('aktif_kuliah_update');
    });

    Route::group([
      'prefix' => 'dinas',
      'as' => 'dinas_',
    ], function(){
      Route::get('/','aktif_kuliah_dinas')->name('aktif_kuliah');
      Route::get('/dataTable','aktif_kuliah_dataTable_dinas')->name('dataTable.aktif_kuliah');
      Route::get('/add','aktif_kuliah_dinas_create')->name('aktif_kuliah_create');
      Route::post('/store','aktif_kuliah_dinas_store')->name('aktif_kuliah_store');
      Route::get('/edit/{id}','aktif_kuliah_dinas_edit')->name('aktif_kuliah_edit');
      Route::put('/update/{id}','aktif_kuliah_dinas_update')->name('aktif_kuliah_update');
    });
  });

  // Observasi 
  Route::group([
    'prefix' => 'observasi',
    'namespace' => 'App\Http\Controllers\Mahasiswa',
    'controller' => ObservasiController::class,
  ], function(){
    Route::get('/','observasi')->name('observasi');
    Route::get('/dataTable','observasi_dataTable')->name('dataTable.observasi');
    Route::get('/add','observasi_create')->name('observasi_create');
    Route::post('/store','observasi_store')->name('observasi_store');
    Route::get('/edit/{id}','observasi_edit')->name('observasi_edit');
    Route::put('/update/{id}','observasi_update')->name('observasi_update');
    Route::group([
      'prefix' => 'anggota',
      'as' => 'anggota.'
    ], function(){
      Route::get('/{id}/add','anggota_observasi_create')->name('observasi_create');
      Route::post('/{id}/store','anggota_observasi_store')->name('observasi_store');
      Route::get('/{id}/delete','anggota_observasi_destroy')->name('observasi_destroy');
    });
  });

  // Observasi kelompok
  Route::group([
    'prefix' => 'observasi_kelompok',
    'namespace' => 'App\Http\Controllers\Mahasiswa',
    'controller' => ObservasiKelompokController::class
  ], function(){
    Route::get('/','observasi_kelompok')->name('observasi_kelompok');
    Route::get('/dataTable','observasi_kelompok_dataTable')->name('dataTable.observasi_kelompok');
    Route::get('/add','observasi_kelompok_create')->name('observasi_kelompok_create');
    Route::post('/store','observasi_kelompok_store')->name('observasi_kelompok_store');
    Route::get('/edit/{id}','observasi_kelompok_edit')->name('observasi_kelompok_edit');
    Route::put('/update/{id}','observasi_kelompok_update')->name('observasi_kelompok_update');
    Route::group([
      'prefix' => 'anggota',
      'as' => 'anggota.'
    ], function(){
      Route::get('/{id}/add','anggota_observasi_kelompok_create')->name('observasi_kelompok_create');
      Route::post('/{id}/store','anggota_observasi_kelompok_store')->name('observasi_kelompok_store');
      Route::get('/{id}/delete','anggota_observasi_kelompok_destroy')->name('observasi_kelompok_destroy');
    });
  });

  // Surat Izin
  Route::group([
    'prefix' => 'surat/izin',
    'namespace' => 'App\Http\Controllers\Mahasiswa',
    'controller' => SuratIzinController::class
  ], function(){
    Route::get('/','surat_izin')->name('surat_izin');
    Route::get('/dataTable','surat_izin_dataTable')->name('dataTable.surat_izin');
    Route::get('/add','surat_izin_create')->name('surat_izin_create');
    Route::post('/store','surat_izin_store')->name('surat_izin_store');
    Route::get('/edit/{id}','surat_izin_edit')->name('surat_izin_edit');
    Route::put('/update/{id}','surat_izin_update')->name('surat_izin_update');
  });
});





Route::redirect('/','/login');

// Authentication
Route::middleware('guest')->group(function(){
  Route::get('login', [LoginController::class, 'login'])->name('login');
  Route::post('login', [LoginController::class, 'authenticate']);
});

// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Fallback
Route::fallback(function () {
  return abort(404);
});