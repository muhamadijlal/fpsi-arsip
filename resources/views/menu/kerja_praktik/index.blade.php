@extends('master.index')

@section('title',Auth::user()->role != 'tu' ?  Breadcrumbs::render('KP.Mahasiswa') : Breadcrumbs::render('KP.Tu'))

@section('content')

<div class="row">
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">KERJA PRAKTIK UMUM</h5>
        <p class="card-text">Arsip Kerja Praktik Jenis Umum</p>
        <a href="{{ Auth::user()->role != 'mahasiswa' ? route('tu.umum_kerja_praktik') : route('mahasiswa.umum_kerja_praktik') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">KERJA PRAKTIK DINAS</h5>
        <p class="card-text">Arsip Kerja Praktik Jenis Dinas</p>
        <a href="{{ Auth::user()->role != 'mahasiswa' ? route('tu.dinas_kerja_praktik') : route('mahasiswa.dinas_kerja_praktik') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
</div>
@endsection