@extends('master.index')

@section('title',Breadcrumbs::render('legalisasiMahasiswa.create'))


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ route('mahasiswa.legalisasi_store') }}" method="post">
          @csrf

          <div class="mb-3">
              <label for="nomor_ijazah">Nomor Ijazah<span style="color:red;" class="form-label">*</span></label>
              <input type="text" class="form-control @error('nomor_ijazah') is-invalid @enderror" name="nomor_ijazah" id="nomor_ijazah" value="{{old('nomor_ijazah')}}" autocomplete="off">
              @error('nomor_ijazah')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
          </div>

          <div class="mb-3">
            <label for="nama">Nama<span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{old('nama')}}" autocomplete="off">
            @error('nama')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="tahun_lulus">Tahun Lulus <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus" id="tahun_lulus" value="{{old('tahun_lulus')}}" autocomplete="off">
            @error('tahun_lulus')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="tanggal_lulus">Tanggal Lulus <span style="color:red;" class="form-label">*</span></label>
            <input class="form-control @error('tanggal_lulus') is-invalid @enderror" type="date" name="tanggal_lulus" id="tanggal_lulus" value="{{old('tanggal_lulus')}}">
            @error('tanggal_lulus')
              <div class="text-danger">
                  {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="keterangan">Keterangan <span style="color:red;" class="form-label">*</span></label>
            <input class="form-control @error('keterangan') is-invalid @enderror" type="text" name="keterangan" id="keterangan" value="{{old('keterangan')}}">
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