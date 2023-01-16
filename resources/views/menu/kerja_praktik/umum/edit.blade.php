@extends('master.index')

@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('KP.Mahasiswa.umum.edit', $kp) : Breadcrumbs::render('KP.Tu.umum.edit', $kp))


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role != 'mahasiswa' ? route('tu.umum_kerja_praktik_update', $kp->id) : route('mahasiswa.umum_kerja_praktik_update', $kp->id) }}" method="post">
          @method('PUT')
          @csrf

          @if(Auth::user()->role != 'mahasiswa')
          <div class="mb-3">
            <label for="nomor_dokumen">Nomor Dokumen <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" name="nomor_dokumen" id="nomor_dokumen" value="{{ $kp->nomor_dokumen }}" autocomplete="off">
            @error('nomor_dokumen')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>
          @endif

          <div class="mb-3">
            <label for="tempat">Tempat pelaksanaan kerja praktik <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" id="tempat" value="{{ $kp->tempat }}" autocomplete="off">
            @error('tempat')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="mb-3">
              <label for="nama">Nama Lengkap Mahasiswa <span style="color:red;" class="form-label">*</span></label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ $kp->nama }}" autocomplete="off" {{ Auth::user()->role == 'mahasiswa' ? 'readonly' : "" }}>
              @error('nama')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col-lg">
            <div class="mb-3">
              <label for="nim">NIM Mahasiswa <span style="color:red;" class="form-label">*</span></label>
              <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ $kp->nim }}" autocomplete="off" {{ Auth::user()->role == 'mahasiswa' ? 'readonly' : "" }}>
              @error('nim')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="mt-3">
          <label class="d-block text-dark"><span style="color:red;">*</span> Wajib diisi</label>
          <button type="submit" class="btn btn-outline-success"> <i class="bx bx-upload"></i> Upload</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection