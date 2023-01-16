@extends('master.index')

@section('title','Menu Dosen Pengabdian')

@section('content')
<div class="row">
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">LAPORAN DAN ARTIKEL PENGABDIAN</h5>
        <p class="card-text">Arsip Laporan dan Artikel Pengabdian</p>
        <a href="{{ url('/dosen/pengabdian/laporan/artikel') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">LAPORAN TANPA PROSIDING</h5>
        <p class="card-text">Arsip Laporan Tanpa Prosiding</p>
        <a href="{{ url('/dosen/pengabdian/laporan/tanpa/prosiding') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
</div>
@endsection