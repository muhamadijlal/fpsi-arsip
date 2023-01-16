@extends('master.index')

@section('title', Auth::user()->role != 'tu' ? Breadcrumbs::render('konseling.edit', $konseling) : Breadcrumbs::render('tu/konseling.edit', $konseling))


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role != 'dosen' ? route('tu.konseling_update', $konseling->id) : route('dosen.konseling_update', $konseling->id) }}" method="post">
          @method('PUT')
          @csrf

          @if(Auth::user()->role != 'dosen')
          <div class="mb-3">
            <label for="nomor_dokumen">Nomor Dokumen<span style="color:red;" class="form-label"> *</span></label>
            <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" name="nomor_dokumen" id="nomor_dokumen" value="{{ $konseling->nomor_dokumen }}" autocomplete="off">
            @error('nomor_dokumen')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>
          @endif

          <div class="mb-3">
              <label for="nama_dokumen">Nama Dokumen<span style="color:red;" class="form-label">*</span></label>
              <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror" name="nama_dokumen" id="nama_dokumen" value="{{ $konseling->nama_dokumen }}" autocomplete="off">
              @error('nama_dokumen')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
          </div>

          <div class="mb-3">
              <label for="perihal">Perihal</label>
              <input type="text" class="form-control @error('perihal') is-invalid @enderror" name="perihal" id="perihal" value="{{ $konseling->perihal }}" autocomplete="off">
              @error('perihal')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="tanggal_awal">Tanggal Awal Pelaksanaan <span style="color:red;" class="form-label">*</span></label>
                <input class="form-control @error('tanggal_awal') is-invalid @enderror" type="date" name="tanggal_awal" id="tanggal_awal" value="{{ $konseling->tanggal_awal }}">
                @error('tanggal_awal')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
            <div class="col-lg">
              <div class="mb-3">
                <label for="tanggal_akhir">Tanggal Akhir Pelaksanaan <span style="color:red;" class="form-label">*</span></label>
                <input class="form-control @error('tanggal_akhir') is-invalid @enderror" type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ $konseling->tanggal_akhir }}">
                @error('tanggal_akhir')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            </div>
          </div>

          <label class="d-block text-dark"><span style="color:red;">*</span> Wajib diisi</label>

          <button type="submit" class="btn btn-outline-success"> <i class="bx bx-upload"></i> Upload</button>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection