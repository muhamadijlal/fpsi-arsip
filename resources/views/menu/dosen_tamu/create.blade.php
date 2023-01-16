@extends('master.index')

@section('title', Auth::user()->role != 'tu' ?  Breadcrumbs::render('dosenTamu.create') : Breadcrumbs::render('tu/dosenTamu.create'))

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role != 'dosen' ? route('tu.dosen_tamu_store') : route('dosen.dosen_tamu_store') }}" method="post"
            enctype="multipart/form-data">
            @csrf

            @if(Auth::user()->role == 'tu')
              <div class="mb-3">
                <label for="nomor_dokumen">Nomor Dokumen <span style="color:red;">*</span></label>
                <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" name="nomor_dokumen" id="nomor_dokumen" value="{{old('nomor_dokumen')}}" autocomplete="off">
                @error('nomor_dokumen')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>
            @endif

            <div class="mb-3">
              <label for="pemohon">Pemohon <span style="color:red;">*</span></label>
              <input type="text" class="form-control @error('pemohon') is-invalid @enderror" name="pemohon" id="pemohon" value="{{old('pemohon')}}" autocomplete="off">
              @error('pemohon')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="nama_lengkap_gelar">Nama lengkap gelar dosen tamu  <span style="color:red;">*</span></label>
              <input type="text" class="form-control @error('nama_lengkap_gelar') is-invalid @enderror"
                  name="nama_lengkap_gelar" id="nama_lengkap_gelar" value="{{old('nama_lengkap_gelar')}}" autocomplete="off">
              @error('nama_lengkap_gelar')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="instansi">Instansi Dosen Tamu <span style="color:red;">*</span></label>
              <input type="text" class="form-control @error('instansi') is-invalid @enderror"
                  name="instansi" id="instansi" value="{{old('instansi')}}" autocomplete="off">
              @error('instansi')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="mata_kuliah">Mata Kuliah <span style="color:red;">*</span></label>
                  <input type="text" class="form-control @error('mata_kuliah') is-invalid @enderror" name="mata_kuliah" id="mata_kuliah" value="{{old('mata_kuliah')}}" autocomplete="off">
                  @error('mata_kuliah')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg">
                <div class="mb-3">
                  <label for="semester">Semester <span style="color:red;">*</span></label>
                  <input type="text" class="form-control @error('semester') is-invalid @enderror" name="semester" id="semester" value="{{old('semester')}}" autocomplete="off" placeholder="contoh: Semester (1)">
                  @error('semester')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="tanggal">Tanggal Pelaksanaan <span style="color:red;">*</span></label>
                  <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}" autocomplete="off">
                  @error('tanggal')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg">
                <div class="mb-3">
                  <label for="waktu">Waktu Pelaksanaan <span style="color:red;">*</span></label>
                  <input type="time" class="form-control @error('waktu') is-invalid @enderror" name="waktu" id="waktu" value="{{old('waktu')}}" autocomplete="off">
                  @error('waktu')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="tempat">Tempat Pelaksanaan <span style="color:red;">*</span></label>
                  <input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" id="tempat" value="{{old('tempat')}}" autocomplete="off">
                  @error('tempat')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg">
                <div class="mb-3">
                  <label for="jenis_pelaksanaan">Jenis Pelaksanaan <span style="color:red;">*</span></label>
                  <select name="jenis_pelaksanaan" id="jenis_pelaksanaan" class="form-control @error('jenis_pelaksanaan') is-invalid @enderror">
                      <option value="" >-- Pilih --</option>
                      <option value="offline" {{old('jenis_pelaksanaan') == 'offline' ? 'selected' : ''}}>Offline</option>
                      <option value="online" {{old('jenis_pelaksanaan') == 'online' ? 'selected' : ''}}>Online</option>
                  </select>
                  @error('jenis_pelaksanaan')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="mt-5">
              <label class="d-block text-dark"><span style="color:red;">*</span> Wajib diisi</label>
              <button type="submit" class="btn btn-outline-success"> <i class="bx bx-upload"></i> Upload</button>
            </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection