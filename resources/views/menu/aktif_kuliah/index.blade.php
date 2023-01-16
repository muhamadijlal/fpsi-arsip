@extends('master.index')

@section('title',Auth::user()->role != 'tu' ?  Breadcrumbs::render('aktifKuliah.Mahasiswa') : Breadcrumbs::render('aktifKuliah.Tu'))

@section('content')
<div class="row">
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">AKTIF KULIAH UMUM</h5>
        <p class="card-text">Arsip Aktif Kuliah Jenis Umum</p>
        <a href="{{ Auth::user()->role != 'mahasiswa' ? route('tu.umum_aktif_kuliah') : route('mahasiswa.umum_aktif_kuliah') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">AKTIF KULIAH DINAS</h5>
        <p class="card-text">Arsip Aktif Kuliah Jenis Dinas</p>
        <a href="{{ Auth::user()->role != 'mahasiswa' ? route('tu.dinas_aktif_kuliah') : route('mahasiswa.dinas_aktif_kuliah') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
</div>
@endsection