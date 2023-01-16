@extends('master.index')

@section('title',Breadcrumbs::render('penunjang'))

@section('content')
<div class="row">
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">SERTIFIKAT</h5>
        <p class="card-text">Arsip Sertifikat</p>
        <a href="{{ url('/dosen/penunjang/sertifikat/') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">SURAT KUNJUNGAN DOSEN TAMU</h5>
        <p class="card-text">Arsip Surat Kunjungan Dosen Tamu</p>
        <a href="{{ url('/dosen/penunjang/dosen/tamu') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">KONSELING</h5>
        <p class="card-text">Arsip Konseling</p>
        <a href="{{ url('/dosen/penunjang/konseling') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
</div>
@endsection