@extends('master.index')

@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('legalisasiMahasiswa.edit', $legalisasi) : Breadcrumbs::render('legalisasiTu.edit', $legalisasi) )


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role == 'mahasiswa' ? route('mahasiswa.legalisasi_update', $legalisasi->id) : route('tu.legalisasi_update', $legalisasi->id) }}" method="post">
          @method('PUT')
          @csrf

          @if(Auth::user()->role != 'mahasiswa')
            <div class="mb-3">
              <label for="nomor_legalisasi">Nomor Legalisasi<span style="color:red;" class="form-label"> *</span></label>
              <input type="text" class="form-control @error('nomor_legalisasi') is-invalid @enderror" name="nomor_legalisasi" id="nomor_legalisasi" value="{{ $legalisasi->nomor_legalisasi }}" autocomplete="off">
              @error('nomor_legalisasi')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
          @endif

          <div class="mb-3">
              <label for="nomor_ijazah">Nomor Ijazah<span style="color:red;" class="form-label">*</span></label>
              <input type="text" class="form-control @error('nomor_ijazah') is-invalid @enderror" name="nomor_ijazah" id="nomor_ijazah" value="{{ $legalisasi->nomor_ijazah }}" autocomplete="off">
              @error('nomor_ijazah')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
          </div>

          <div class="mb-3">
            <label for="nama">Nama<span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ $legalisasi->nama }}" autocomplete="off">
            @error('nama')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="tahun_lulus">Tahun Lulus <span style="color:red;" class="form-label">*</span></label>
            <input class="form-control @error('tahun_lulus') is-invalid @enderror" type="text" name="tahun_lulus" id="tahun_lulus" value="{{ $legalisasi->tahun_lulus }}">
            @error('tahun_lulus')
              <div class="text-danger">
                  {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="tanggal_lulus">Tanggal Lulus <span style="color:red;" class="form-label">*</span></label>
            <input class="form-control @error('tanggal_lulus') is-invalid @enderror" type="date" name="tanggal_lulus" id="tanggal_lulus" value="{{ $legalisasi->tanggal_lulus }}">
            @error('tanggal_lulus')
              <div class="text-danger">
                  {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="keterangan">Keterangan <span style="color:red;" class="form-label">*</span></label>
            <input class="form-control @error('keterangan') is-invalid @enderror" type="text" name="keterangan" id="keterangan" value="{{ $legalisasi->keterangan }}">
            @error('keterangan')
              <div class="text-danger">
                  {{ $message }}
              </div>
            @enderror
          </div>

          <label class="d-block text-dark"><span style="color:red;">*</span> Wajib diisi</label>

          <button type="submit" class="btn btn-outline-success"> <i class="bx bx-upload"></i> Upload</button>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection