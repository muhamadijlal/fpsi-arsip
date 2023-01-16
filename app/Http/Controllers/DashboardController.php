<?php

namespace App\Http\Controllers;

use App\Models\Ms_aktifKuliah;
use App\Models\Ms_Dosentamu;
use App\Models\Ms_kerjaPraktik;
use App\Models\Ms_Konseling;
use App\Models\Ms_legalisasi;
use App\Models\Ms_observasi;
use App\Models\Ms_observasiKelompok;
use App\Models\Ms_suratIzin;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboardRoot()
    {
        $users = User::count();
        $dosen = User::where('role','dosen')->count();
        $mahasiswa = User::where('role','mahasiswa')->count();
        $suratIzin = Ms_suratIzin::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $legalisasi = Ms_legalisasi::where('nomor_legalisasi',null)->where('deleted_at',null)->count();
        $kerjaPraktik = Ms_kerjaPraktik::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $aktifKuliah = Ms_aktifKuliah::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $observasi = Ms_observasi::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $observasiKelompok = Ms_observasiKelompok::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $dosenTamu = Ms_Dosentamu::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $konseling = Ms_Konseling::where('nomor_dokumen',null)->where('deleted_at',null)->count();

        return view('dashboard.dashboardRoot',compact('users','dosen','mahasiswa','suratIzin','legalisasi','kerjaPraktik','aktifKuliah','observasi','observasiKelompok','dosenTamu','konseling'));
    }

    public function dashboardDosen()
    {
        $users = User::count();
        $dosen = User::where('role','dosen')->count();
        $mahasiswa = User::where('role','mahasiswa')->count();

        return view('dashboard.dashboardDosen', compact('users','dosen','mahasiswa'));
    }

    public function dashboardTU()
    {
        $users = User::count();
        $dosen = User::where('role','dosen')->count();
        $mahasiswa = User::where('role','mahasiswa')->count();
        $suratIzin = Ms_suratIzin::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $legalisasi = Ms_legalisasi::where('nomor_legalisasi',null)->where('deleted_at',null)->count();
        $kerjaPraktik = Ms_kerjaPraktik::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $aktifKuliah = Ms_aktifKuliah::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $observasi = Ms_observasi::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $observasiKelompok = Ms_observasiKelompok::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $dosenTamu = Ms_Dosentamu::where('nomor_dokumen',null)->where('deleted_at',null)->count();
        $konseling = Ms_Konseling::where('nomor_dokumen',null)->where('deleted_at',null)->count();

        return view('dashboard.dashboardTU', compact('users','dosen','mahasiswa','suratIzin','legalisasi','kerjaPraktik','aktifKuliah','observasi','observasiKelompok','dosenTamu','konseling'));
    }

    public function dashboardMahasiswa()
    {
        $users = User::count();
        $dosen = User::where('role','dosen')->count();
        $mahasiswa = User::where('role','mahasiswa')->count();

        return view('dashboard.dashboardMahasiswa', compact('users','dosen','mahasiswa'));
    }

    public function dashboardKepala()
    {
        $users = User::count();
        $dosen = User::where('role','dosen')->count();
        $mahasiswa = User::where('role','mahasiswa')->count();

        return view('dashboard.dashboardKepala', compact('users','dosen','mahasiswa'));
    }

}
