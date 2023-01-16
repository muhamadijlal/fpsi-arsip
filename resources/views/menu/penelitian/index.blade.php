@extends('master.index')

@section('title',Breadcrumbs::render('penelitian'))

@section('content')
<div class="row">
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">JURNAL PENELITIAN / PROSIDING</h5>
        <p class="card-text">Arsip Jurnal Penelitian atau Jurnal Prosiding</p>
        <a href="{{ url('/dosen/penelitian/jurnal/prosiding') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">SURAT PENELITIAN</h5>
        <p class="card-text">Arsip Surat Penelitian</p>
        <a href="{{ url('/dosen/penelitian/surat') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">LAPORAN DAN ARTIKEL PENELITIAN</h5>
        <p class="card-text">Arsip Laporan dan Artikel Penelitian</p>
        <a href="{{ url('/dosen/penelitian/laporan/artikel') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">SURAT TUGAS PENELITIAN</h5>
        <p class="card-text">Arsip Surat Tugas Penelitian</p>
        <a href="{{ url('/dosen/penelitian/surat/tugas') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
</div>
@endsection