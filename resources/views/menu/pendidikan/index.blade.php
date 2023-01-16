@extends('master.index')

{{-- @section('title', Breadcrumbs::render('pendidikan')) --}}

@section('content')
<div class="row">
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">SK PEMBIMBING KP/TA/PKM</h5>
        <p class="card-text">Arsip SK Pembimbing KP, TA dan PKM</p>
        <a href="{{ Auth::user()->role == 'dosen' ? url('/dosen/pendidikan/pembimbing') : url('/root/pendidikan/pembimbing') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">SK PENETAPAN JADWAL KULIAH</h5>
        <p class="card-text">Arsip SK Penetapan Jadwal Kuliah</p>
        <a href="{{ Auth::user()->role == 'dosen' ? url('/dosen/pendidikan/jadwal_kuliah') : url('/root/pendidikan/jadwal_kuliah') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">SK YUDISIUM</h5>
        <p class="card-text">Arsip SK Yudisium</p>
        <a href="{{ Auth::user()->role == 'dosen' ? url('/dosen/pendidikan/yudisium') :  url('/root/pendidikan/yudisium') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">SK KOORDINATOR DAN PRODI</h5>
        <p class="card-text">Arsip SK Koordinator dan Program Studi</p>
        <a href="{{ Auth::user()->role == 'dosen' ? url('/dosen/pendidikan/koorprodi') : url('/root/pendidikan/koorprodi') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-4 mb-3">
    <div class="card text-center">
      <div class="card-body">
        <h5 class="card-title">SK LAINNYA</h5>
        <p class="card-text">Arsip SK lain lain</p>
        <a href="{{  Auth::user()->role == 'dosen' ? url('/dosen/pendidikan/lainnya') : url('/root/pendidikan/lainnya') }}" class="btn btn-outline-primary">Klik disini!</a>
      </div>
    </div>
  </div>
</div>
@endsection