<?php

use Illuminate\Support\Facades\Auth;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
// Breadcrumbs::for('dosen.dashboard', function ($trail) {
//     $trail->push('Dashboard', route('dosen.dashboard'));
// });

// ========================= Pendidikan ========================= //
// ------------------------- pembimbing ------------------------- //

// Pendidikan
Breadcrumbs::for('pendidikan', function ($trail){
    $trail->push('Pendidikan', route('dosen.pendidikan'));
});

// Pendidikan >> SK PEMBIMBING KP/TA/PKM
Breadcrumbs::for('pembimbing', function($trail){
    $trail->parent('pendidikan');
    $trail->push('SK Pembimbing', route('dosen.pembimbing'));
});

// Pendidikan >> SK PEMBIMBING KP/TA/PKM >> Create New
Breadcrumbs::for('pembimbing.create', function($trail){
    $trail->parent('pembimbing');
    $trail->push('Create New', route('dosen.pembimbing_create'));
});

// Pendidikan >> SK PEMBIMBING KP/TA/PKM >> Edit [dokumen name]
Breadcrumbs::for('pembimbing.edit', function($trail, $data){
    $trail->parent('pembimbing');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.pembimbing_edit', $data->id));
});

// ========================= Pendidikan ========================= //
// ----------------------- Jadwal Kuliah ----------------------- //

// pendidikan >> jadwal kuliah
Breadcrumbs::for('jadwal', function($trail){
    $trail->parent('pendidikan');
    $trail->push('SK Penetapan Jadwal Kuliah', route('dosen.jadwal_kuliah'));
});

// pendidikan >> jadwal kuliah >> Create New
Breadcrumbs::for('jadwal.create', function($trail){
    $trail->parent('jadwal');
    $trail->push('Create New', route('dosen.jadwal_kuliah_create'));
});

// pendidikan >> jadwal kuliah >> Edit [nama dokumen]
Breadcrumbs::for('jadwal.edit', function($trail, $data){
    $trail->parent('jadwal');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.jadwal_kuliah_edit', $data->id));
});



// ========================= Pendidikan ========================= //
// -------------------------- Yudisium -------------------------- //

// pendidikan >> Yudisium
Breadcrumbs::for('yudisium', function($trail){
    $trail->parent('pendidikan');
    $trail->push('SK Yudisium', route('dosen.yudisium'));
});

// pendidikan >> yudisium >> Create New
Breadcrumbs::for('yudisium.create', function($trail){
    $trail->parent('yudisium');
    $trail->push('Create New', route('dosen.yudisium_create'));
});

// pendidikan >> yudisium >> Edit [nama dokumen]
Breadcrumbs::for('yudisium.edit', function($trail, $data){
    $trail->parent('yudisium');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.yudisium_edit', $data->id));
});


// ========================= Pendidikan ========================= //
// ----------------- Jadwal Koordinator dan Prodi ----------------- //

// pendidikan >> koorprodi
Breadcrumbs::for('koorprodi', function($trail){
    $trail->parent('pendidikan');
    $trail->push('SK Koordinartor dan Prodi', route('dosen.koorprodi'));
});

// pendidikan >> koorprodi >> Create New
Breadcrumbs::for('koorprodi.create', function($trail){
    $trail->parent('koorprodi');
    $trail->push('Create New', route('dosen.koorprodi_create'));
});

// pendidikan >> koorprodi >> Edit [nama dokumen]
Breadcrumbs::for('koorprodi.edit', function($trail, $data){
    $trail->parent('koorprodi');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.koorprodi_edit', $data->id));
});


// ========================= Pendidikan ========================= //
// -------------------------- Lainnya -------------------------- //

// pendidikan >> lainnya
Breadcrumbs::for('lainnya', function($trail){
    $trail->parent('pendidikan');
    $trail->push('SK Lain-Lain', route('dosen.lainnya'));
});

// pendidikan >> lainnya >> Create New
Breadcrumbs::for('lainnya.create', function($trail){
    $trail->parent('lainnya');
    $trail->push('Create New', route('dosen.lainnya_create'));
});

// pendidikan >> lainnya >> Edit [nama dokumen]
Breadcrumbs::for('lainnya.edit', function($trail, $data){
    $trail->parent('lainnya');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.lainnya_edit', $data->id));
});

// ========================= Penelitian ========================= //

// Penelitian
Breadcrumbs::for('penelitian', function($trail){
    $trail->push('Penelitian', route('dosen.penelitian'));
});

// ========================= Penelitian ========================= //
// ----------------------- Jurnal Pelpro ----------------------- //

// Penelitian >> Jurnal Penelitian / Prosiding
Breadcrumbs::for('pelpro', function($trail){
    $trail->parent('penelitian');
    $trail->push('Jurnal penelitian (Prosiding)', route('dosen.pelpro'));
});

// Penelitian >> Jurnal Penelitian / Prosiding >> Create New
Breadcrumbs::for('pelpro.create', function($trail){
    $trail->parent('pelpro');
    $trail->push('Create New', route('dosen.pelpro_create'));
});

// Penelitian >> Jurnal Penelitian / Prosiding >> Edit [nama dokumen]
Breadcrumbs::for('pelpro.edit', function($trail, $data){
    $trail->parent('pelpro');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.pelpro_edit', $data->id));
});

// ========================= Penelitian ========================= //
// --------------------- Surat Penelitian --------------------- //

// Penelitian >> Surat Penelitian
Breadcrumbs::for('surat', function($trail){
    $trail->parent('penelitian');
    $trail->push('Surat Penelitian', route('dosen.surat'));
});

// Penelitian >> Surat Penelitian >> Create New
Breadcrumbs::for('surat.create', function($trail){
    $trail->parent('surat');
    $trail->push('Create New', route('dosen.surat_create'));
});

// Penelitian >> Surat Penelitian >> Edit [nama dokumen]
Breadcrumbs::for('surat.edit', function($trail, $data){
    $trail->parent('surat');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.surat_edit', $data->id));
});

// ========================= Penelitian ========================= //
// -------------- Laporan dan Artikel Penelitian -------------- //

// Penelitian >> Laporan dan Artikel Penelitian
Breadcrumbs::for('laporanArtikel', function($trail){
    $trail->parent('penelitian');
    $trail->push('Laporan dan Artikel Penelitian', route('dosen.laporanArtikel'));
});

// Penelitian >> Laporan dan Artikel Penelitian >> Create New
Breadcrumbs::for('laporanArtikel.create', function($trail){
    $trail->parent('laporanArtikel');
    $trail->push('Create New', route('dosen.laporanArtikel_create'));
});

// Penelitian >> Laporan dan Artikel Penelitian >> Edit [nama dokumen]
Breadcrumbs::for('laporanArtikel.edit', function($trail, $data){
    $trail->parent('laporanArtikel');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.laporanArtikel_edit', $data->id));
});

// ========================= Penelitian ========================= //
// ------------------- Surat tugas Penelitian ------------------- //

// Penelitian >> Surat Tugas Penelitian
Breadcrumbs::for('suratTugas', function($trail){
    $trail->parent('penelitian');
    $trail->push('Surat Tugas Penelitian', route('dosen.suratTugas'));
});

// Penelitian >> Surat Tugas Penelitian >> Create New
Breadcrumbs::for('suratTugas.create', function($trail){
    $trail->parent('suratTugas');
    $trail->push('Create New', route('dosen.suratTugas_create'));
});

// Penelitian >> Surat Tugas Penelitian >> Edit [nama dokumen]
Breadcrumbs::for('suratTugas.edit', function($trail, $data){
    $trail->parent('suratTugas');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.suratTugas_edit', $data->id));
});

// ========================= Penelitian ========================= //

Breadcrumbs::for('pengabdian', function($trail){
    $trail->push('pengabdian', route('dosen.pengabdian'));
});

// ========================= pengabdian ========================= //
// -------------------Laporan da Artikel pengabdian ------------------- //

// pengabdian >>Laporan da Artikel pengabdian
Breadcrumbs::for('laporanArtikelPengabdian', function($trail){
    $trail->parent('pengabdian');
    $trail->push('Laporan dan Artikel', route('dosen.laporan_artikel_pengabdian'));
});

// pengabdian >>Laporan da Artikel pengabdian >> Create New
Breadcrumbs::for('laporanArtikelPengabdian.create', function($trail){
    $trail->parent('laporanArtikelPengabdian');
    $trail->push('Create New', route('dosen.laporan_artikel_pengabdian_create'));
});

// pengabdian >>Laporan da Artikel pengabdian >> Edit [nama dokumen]
Breadcrumbs::for('laporanArtikelPengabdian.edit', function($trail, $data){
    $trail->parent('laporanArtikelPengabdian');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.laporan_artikel_pengabdian_edit', $data->id));
});

// ========================= pengabdian ========================= //
// ------------------- Laporan tanpa Prosiding ------------------- //

// pengabdian >> Laporan da Artikel pengabdian
Breadcrumbs::for('laporanTanpaProsiding', function($trail){
    $trail->parent('pengabdian');
    $trail->push('Laporan Tanpa Prosiding', route('dosen.laporan_tanpa_prosiding'));
});

// pengabdian >> Laporan da Artikel pengabdian >> Create New
Breadcrumbs::for('laporanTanpaProsiding.create', function($trail){
    $trail->parent('laporanTanpaProsiding');
    $trail->push('Create New', route('dosen.laporan_tanpa_prosiding_create'));
});

// pengabdian >> Laporan da Artikel pengabdian >> Edit [nama dokumen]
Breadcrumbs::for('laporanTanpaProsiding.edit', function($trail, $data){
    $trail->parent('laporanTanpaProsiding');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.laporan_tanpa_prosiding_edit', $data->id));
});

// ========================= penunjang ========================= //
Breadcrumbs::for('penunjang', function($trail){
    $trail->push('Penunjang', route('dosen.penunjang'));
});

// ========================= penunjang ========================= //
// ------------------- Sertifikat ------------------- //
Breadcrumbs::for('sertifikat', function($trail){
    $trail->parent('penunjang');
    $trail->push('Sertifikat', route('dosen.sertifikat'));
});

Breadcrumbs::for('sertifikat.create', function($trail){
    $trail->parent('sertifikat');
    $trail->push('Creat New', route('dosen.sertifikat_create'));
});

Breadcrumbs::for('sertifikat.edit', function($trail, $data){
    $trail->parent('sertifikat');
    $trail->push("Edit Data $data->nama_dokumen", route('dosen.sertifikat_edit', $data->id));
});

// ========================= penunjang ========================= //
// ------------------- Kunjungan Dosen Tamu ------------------- //
// Dosen
    Breadcrumbs::for('dosenTamu', function($trail){
        $trail->parent('penunjang');
        $trail->push('Surat Kunjungan Dosen Tamu', route('dosen.dosen_tamu'));
    });

    Breadcrumbs::for('dosenTamu.create', function($trail){
        $trail->parent('dosenTamu');
        $trail->push('Creat New', route('dosen.dosen_tamu_create'));
    });

    Breadcrumbs::for('dosenTamu.edit', function($trail, $data){
        $trail->parent('dosenTamu');
        $trail->push("Edit Data $data->nama_dokumen", route('dosen.dosen_tamu_edit', $data->id));
    });

// TU
    Breadcrumbs::for('tu/dosenTamu', function($trail){
        $trail->push('Surat Kunjungan Dosen Tamu', route('tu.dosen_tamu'));
    });

    Breadcrumbs::for('tu/dosenTamu.create', function($trail){
        $trail->parent('tu/dosenTamu');
        $trail->push('Creat New', route('tu.dosen_tamu_create'));
    });

    Breadcrumbs::for('tu/dosenTamu.edit', function($trail, $data){
        $trail->parent('tu/dosenTamu');
        $trail->push("Edit Data $data->nama_dokumen", route('tu.dosen_tamu_edit', $data->id));
    });

// ========================= penunjang ========================= //
// ------------------------- Konseling ------------------------- //

// Dosen
    Breadcrumbs::for('konseling', function($trail){
        $trail->parent('penunjang');
        $trail->push('Konseling', route('dosen.konseling'));
    });

    Breadcrumbs::for('konseling.create', function($trail){
        $trail->parent('konseling');
        $trail->push('Creat New', route('dosen.konseling_create'));
    });

    Breadcrumbs::for('konseling.edit', function($trail, $data){
        $trail->parent('konseling');
        $trail->push("Edit Data $data->nama_dokumen", route('dosen.konseling_edit', $data->id));
    });

// TU

    Breadcrumbs::for('tu/konseling', function($trail){
        $trail->push('Konseling', route('tu.konseling'));
    });

    Breadcrumbs::for('tu/konseling.create', function($trail){
        $trail->parent('tu/konseling');
        $trail->push('Creat New', route('tu.konseling_create'));
    });

    Breadcrumbs::for('tu/konseling.edit', function($trail, $data){
        $trail->parent('tu/konseling');
        $trail->push("Edit Data $data->nama_dokumen", route('tu.konseling_edit', $data->id));
    });

// ========================= Tata Usaha ========================= //
// ------------------------- Surat Izin ------------------------- //

Breadcrumbs::for('tu/suratIzin', function($trail){
    $trail->push('Surat Izin', route('tu.surat_izin'));
});

Breadcrumbs::for('tu/suratIzin.create', function($trail){
    $trail->parent('tu/suratIzin');
    $trail->push('Creat New', route('tu.surat_izin_create'));
});

Breadcrumbs::for('tu/suratIzin.edit', function($trail, $data){
    $trail->parent('tu/suratIzin');
    $trail->push("Edit $data->nama", route('tu.surat_izin_edit', $data->id));
});

// ========================= Mahasiswa ========================= //
// ------------------------- Surat Izin ------------------------- //

Breadcrumbs::for('mahasiswa/suratIzin', function($trail){
    $trail->push('Surat Izin', route('mahasiswa.surat_izin'));
});

Breadcrumbs::for('mahasiswa/suratIzin.create', function($trail){
    $trail->parent('mahasiswa/suratIzin');
    $trail->push('Creat New', route('mahasiswa.surat_izin_create'));
});

Breadcrumbs::for('mahasiswa/suratIzin.edit', function($trail, $data){
    $trail->parent('mahasiswa/suratIzin');
    $trail->push("Edit $data->nama", route('mahasiswa.surat_izin_edit', $data->id));
});

// ========================= Mahasiswa ========================= //
// ------------------------- Arsip Tu ------------------------- //

Breadcrumbs::for('arsipTu', function($trail){
    $trail->push('Arsip Tata Usaha', route('tu.arsip'));
});

Breadcrumbs::for('arsipTu.create', function($trail){
    $trail->parent('arsipTu');
    $trail->push('Create New', route('tu.arsip_create'));
});

Breadcrumbs::for('arsipTu.edit', function($trail, $data){
    $trail->parent('arsipTu');
    $trail->push("Edit $data->nama_dokumen", route('tu.arsip_edit', $data->id));
});

// ========================= Tata Usaha ========================= //
// ---------------------- Legalisasi Ijazah ---------------------- //

Breadcrumbs::for('legalisasiTu', function($trail){
    $trail->push('Legalisasi Ijazah', route('tu.legalisasi'));
});

Breadcrumbs::for('legalisasiTu.edit', function($trail, $data){
    $trail->parent('legalisasiTu');
    $trail->push("Edit $data->nomor_legalisasi", route('tu.legalisasi_edit', $data->id));
});

// ========================= Mahasiswa ========================= //
// ------------------------- Legalisasi Ijazah ------------------------- //

Breadcrumbs::for('legalisasiMahasiswa', function($trail){
    $trail->push('Legalisasi Ijazah', route('mahasiswa.legalisasi'));
});

Breadcrumbs::for('legalisasiMahasiswa.create', function($trail){
    $trail->parent('legalisasiMahasiswa');
    $trail->push("Create New", route('mahasiswa.legalisasi_create'));
});

Breadcrumbs::for('legalisasiMahasiswa.edit', function($trail, $data){
    $trail->parent('legalisasiMahasiswa');
    $trail->push("Edit $data->nomor_legalisasi", route('mahasiswa.legalisasi_edit', $data->id));
});

// ========================= Tata Usaha ========================= //
// ----------------------- Kerja Praktik ------------------------- //

// Menu

Breadcrumbs::for('KP.Tu', function($trail){
    $trail->push('Kerja Praktik', route('tu.kerja_praktik'));
});

Breadcrumbs::for('KP.Mahasiswa', function($trail){
    $trail->push('Kerja Praktik', route('mahasiswa.kerja_praktik'));
});

// Index

Breadcrumbs::for('KP.Tu.umum', function($trail){
    $trail->parent('KP.Tu');
    $trail->push('Umum', route('tu.umum_kerja_praktik'));
});

Breadcrumbs::for('KP.Tu.dinas', function($trail){
    $trail->parent('KP.Tu');
    $trail->push('Dinas', route('tu.dinas_kerja_praktik'));
});

// Create

Breadcrumbs::for('KP.Tu.umum.create', function($trail){
    $trail->parent('KP.Tu.umum');
    $trail->push('Create New', route('tu.umum_kerja_praktik_create'));
});

Breadcrumbs::for('KP.Tu.dinas.create', function($trail){
    $trail->parent('KP.Tu.dinas');
    $trail->push('Create New', route('tu.dinas_kerja_praktik_create'));
});

// Edit

Breadcrumbs::for('KP.Tu.umum.edit', function($trail, $data){
    $trail->parent('KP.Tu.umum');
    $trail->push(" Edit $data->nama", route('tu.umum_kerja_praktik_edit', $data->id));
});

Breadcrumbs::for('KP.Tu.dinas.edit', function($trail, $data){
    $trail->parent('KP.Tu.dinas');
    $trail->push(" Edit $data->nama", route('tu.dinas_kerja_praktik_edit', $data->id));
});

// Mahasiswa

Breadcrumbs::for('KP.Mahasiswa.umum', function($trail){
    $trail->parent('KP.Mahasiswa');
    $trail->push('Umum', route('mahasiswa.umum_kerja_praktik'));
});

Breadcrumbs::for('KP.Mahasiswa.dinas', function($trail){
    $trail->parent('KP.Mahasiswa');
    $trail->push('Dinas', route('mahasiswa.dinas_kerja_praktik'));
});

// Create

Breadcrumbs::for('KP.Mahasiswa.umum.create', function($trail){
    $trail->parent('KP.Mahasiswa.umum');
    $trail->push('Create New', route('mahasiswa.umum_kerja_praktik_create'));
});

Breadcrumbs::for('KP.Mahasiswa.dinas.create', function($trail){
    $trail->parent('KP.Mahasiswa.dinas');
    $trail->push('Create New', route('mahasiswa.dinas_kerja_praktik_create'));
});

// Edit

Breadcrumbs::for('KP.Mahasiswa.umum.edit', function($trail, $data){
    $trail->parent('KP.Mahasiswa.umum');
    $trail->push(" Edit $data->nama", route('mahasiswa.umum_kerja_praktik_edit', $data->id));
});

Breadcrumbs::for('KP.Mahasiswa.dinas.edit', function($trail, $data){
    $trail->parent('KP.Mahasiswa.dinas');
    $trail->push(" Edit $data->nama", route('mahasiswa.dinas_kerja_praktik_edit', $data->id));
});

// ========================= Tata Usaha ========================= //
// ----------------------- Aktif Kuliah ------------------------- //

// Menu

Breadcrumbs::for('aktifKuliah.Tu', function($trail){
    $trail->push('Aktif Kuliah', route('tu.aktif_kuliah'));
});

Breadcrumbs::for('aktifKuliah.Mahasiswa', function($trail){
    $trail->push('Aktif Kuliah', route('mahasiswa.aktif_kuliah'));
});

// Index

Breadcrumbs::for('aktifKuliah.Tu.umum', function($trail){
    $trail->parent('aktifKuliah.Tu');
    $trail->push('Umum', route('tu.umum_aktif_kuliah'));
});

Breadcrumbs::for('aktifKuliah.Tu.dinas', function($trail){
    $trail->parent('aktifKuliah.Tu');
    $trail->push('Dinas', route('tu.dinas_aktif_kuliah'));
});

// Create

Breadcrumbs::for('aktifKuliah.Tu.umum.create', function($trail){
    $trail->parent('aktifKuliah.Tu.umum');
    $trail->push('Create New', route('tu.umum_aktif_kuliah_create'));
});

Breadcrumbs::for('aktifKuliah.Tu.dinas.create', function($trail){
    $trail->parent('aktifKuliah.Tu.dinas');
    $trail->push('Create New', route('tu.dinas_aktif_kuliah_create'));
});

// Edit

Breadcrumbs::for('aktifKuliah.Tu.umum.edit', function($trail, $data){
    $trail->parent('aktifKuliah.Tu.umum');
    $trail->push(" Edit $data->nama", route('tu.umum_aktif_kuliah_edit', $data->id));
});

Breadcrumbs::for('aktifKuliah.Tu.dinas.edit', function($trail, $data){
    $trail->parent('aktifKuliah.Tu.dinas');
    $trail->push(" Edit $data->nama", route('tu.dinas_aktif_kuliah_edit', $data->id));
});

// Mahasiswa

Breadcrumbs::for('aktifKuliah.Mahasiswa.umum', function($trail){
    $trail->parent('aktifKuliah.Mahasiswa');
    $trail->push('Umum', route('mahasiswa.umum_aktif_kuliah'));
});

Breadcrumbs::for('aktifKuliah.Mahasiswa.dinas', function($trail){
    $trail->parent('aktifKuliah.Mahasiswa');
    $trail->push('Dinas', route('mahasiswa.dinas_aktif_kuliah'));
});

// Create

Breadcrumbs::for('aktifKuliah.Mahasiswa.umum.create', function($trail){
    $trail->parent('aktifKuliah.Mahasiswa.umum');
    $trail->push('Create New', route('mahasiswa.umum_aktif_kuliah_create'));
});

Breadcrumbs::for('aktifKuliah.Mahasiswa.dinas.create', function($trail){
    $trail->parent('aktifKuliah.Mahasiswa.dinas');
    $trail->push('Create New', route('mahasiswa.dinas_aktif_kuliah_create'));
});

// Edit

Breadcrumbs::for('aktifKuliah.Mahasiswa.umum.edit', function($trail, $data){
    $trail->parent('aktifKuliah.Mahasiswa.umum');
    $trail->push(" Edit $data->nama", route('mahasiswa.umum_aktif_kuliah_edit', $data->id));
});

Breadcrumbs::for('aktifKuliah.Mahasiswa.dinas.edit', function($trail, $data){
    $trail->parent('aktifKuliah.Mahasiswa.dinas');
    $trail->push(" Edit $data->nama", route('mahasiswa.dinas_aktif_kuliah_edit', $data->id));
});

// ========================= Tata Usaha ========================= //
// -------------------------- Observasi -------------------------- //

Breadcrumbs::for('tu/observasi', function($trail){
    $trail->push('Observasi', route('tu.observasi'));
});

Breadcrumbs::for('tu/observasi.create', function($trail){
    $trail->parent('tu/observasi');
    $trail->push('Create New', route('tu.observasi_create'));
});

Breadcrumbs::for('tu/observasi.edit', function($trail, $data){
    $trail->parent('tu/observasi');
    $trail->push("edit $data->nama", route('tu.observasi_edit', $data->id));
});

Breadcrumbs::for('tu/observasi.add', function($trail, $data){
    $trail->parent('tu/observasi');
    $trail->push("Tambah Anggota $data->nama", route('tu.anggota.observasi_create', $data->id));
});
// ========================= Mahasiswa ========================= //
// -------------------------- Observasi -------------------------- //

Breadcrumbs::for('mahasiswa/observasi', function($trail){
    $trail->push('Observasi', route('mahasiswa.observasi'));
});

Breadcrumbs::for('mahasiswa/observasi.create', function($trail){
    $trail->parent('mahasiswa/observasi');
    $trail->push('Create New', route('mahasiswa.observasi_create'));
});

Breadcrumbs::for('mahasiswa/observasi.edit', function($trail, $data){
    $trail->parent('mahasiswa/observasi');
    $trail->push("edit $data->nama", route('mahasiswa.observasi_edit', $data->id));
});

Breadcrumbs::for('mahasiswa/observasi.add', function($trail, $data){
    $trail->parent('mahasiswa/observasi');
    $trail->push("Tambah Anggota $data->nama", route('mahasiswa.anggota.observasi_create', $data->id));
});

// ========================= Tata Usaha ========================= //
// -------------------------- Observasi Kelompok -------------------------- //

Breadcrumbs::for('tu/observasi/kelompok', function($trail){
    $trail->push('Observasi Kelompok', route('tu.observasi_kelompok'));
});

Breadcrumbs::for('tu/observasi/kelompok.create', function($trail){
    $trail->parent('tu/observasi/kelompok');
    $trail->push('Create New', route('tu.observasi_kelompok_create'));
});

Breadcrumbs::for('tu/observasi/kelompok.edit', function($trail, $data){
    $trail->parent('tu/observasi/kelompok');
    $trail->push("edit $data->nama", route('tu.observasi_kelompok_edit', $data->id));
});

Breadcrumbs::for('tu/observasi/kelompok.add', function($trail, $data){
    $trail->parent('tu/observasi/kelompok');
    $trail->push("Tambah Anggota $data->nama", route('tu.anggota.observasi_kelompok_create', $data->id));
});
// ========================= Mahasiswa ========================= //
// -------------------------- Observasi -------------------------- //

Breadcrumbs::for('mahasiswa/observasi/kelompok', function($trail){
    $trail->push('Observasi Kelompok', route('mahasiswa.observasi_kelompok'));
});

Breadcrumbs::for('mahasiswa/observasi/kelompok.create', function($trail){
    $trail->parent('mahasiswa/observasi/kelompok');
    $trail->push('Create New', route('mahasiswa.observasi_kelompok_create'));
});

Breadcrumbs::for('mahasiswa/observasi/kelompok.edit', function($trail, $data){
    $trail->parent('mahasiswa/observasi/kelompok');
    $trail->push("edit $data->nama", route('mahasiswa.observasi_kelompok_edit', $data->id));
});

Breadcrumbs::for('mahasiswa/observasi/kelompok.add', function($trail, $data){
    $trail->parent('mahasiswa/observasi/kelompok');
    $trail->push("Tambah Anggota $data->nama", route('mahasiswa.anggota.observasi_kelompok_create', $data->id));
});

// ========================= Jurnal ========================= //
// -------------------------- root -------------------------- //

Breadcrumbs::for('jurnal', function($trail){
    $trail->push('Jurnal', route('kepala.jurnal'));
});

Breadcrumbs::for('jurnal.create', function($trail){
    $trail->parent('jurnal');
    $trail->push('Create New', route('kepala.jurnal_create'));
});

Breadcrumbs::for('jurnal.edit', function($trail, $data){
    $trail->parent('jurnal');
    $trail->push("Edit $data->nama_dokumen", route('kepala.jurnal_edit', $data->id));
});

Breadcrumbs::for('jurnal.history', function($trail, $data){
    $trail->parent('jurnal');
    $trail->push("History", route('kepala.jurnal_history', $data));
});

Breadcrumbs::for('jurnal.history.create', function($trail, $data){
    $trail->parent('jurnal');
    $trail->push("Creat New History $data->nama_dokumen", route('kepala.jurnal_history_create', $data->id));
});