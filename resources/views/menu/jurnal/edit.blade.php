@extends('master.index')

{{-- @section('title', Breadcrumbs::render('jurnal.edit', $jurnal)) --}}


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role == 'kepala' ? route('kepala.jurnal_update', $jurnal->id) : route('root.jurnal_update', $jurnal->id) }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf

          <div class="mb-3">
            <label for="nama_dokumen">Nama Dokumen<span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror" name="nama_dokumen" id="nama_dokumen" value="{{ $jurnal->nama_dokumen }}" autocomplete="off">
            @error('nama_dokumen')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="perihal">Perihal</label>
            <input type="text" class="form-control @error('perihal') is-invalid @enderror" name="perihal" id="perihal" value="{{ $jurnal->perihal }}" autocomplete="off">
            @error('perihal')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
              <label for="tahun_akademik">Tahun Akademik</label>
              <input type="text" class="form-control @error('tahun_akademik') is-invalid @enderror" name="tahun_akademik" id="tahun_akademik" value="{{ $jurnal->tahun_akademik }}" autocomplete="off">
              @error('tahun_akademik')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
          </div>     

          <div class="mb-3">
            <label for="formFile">File</label>
            <input class="form-control @error('file') is-invalid @enderror" name="file" type="file" id="formFile">
            <sub>Pilih document hanya dengan format .pdf</sub>
            <br>
            <a target="_blank" href="{{ asset('berkas_kepala').'/'.$jurnal->file }}"><i class="bx bx-file" ></i>  File yang ada</a>
            @error('file')
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