@extends('master.index')

@section('title',Breadcrumbs::render('suratTugas.edit',$surat_tugas_penelitian))

@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{url('/dosen/penelitian/surat/tugas/update',$surat_tugas_penelitian->id)}}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf

            <div class="mb-3">
                <label for="nomor_dokumen">Nomor Surat Peneliatan<span style="color:red;" class="form-label"> *</span></label>
                <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" name="nomor_dokumen" id="nomor_dokumen" value="{{$surat_tugas_penelitian->nomor_dokumen}}" autocomplete="off">
                @error('nomor_dokumen')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror

            </div>

            <div class="mb-3">
                <label for="nama_dokumen">Nama Dokumen<span style="color:red;" class="form-label">*</span></label>
                <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror" name="nama_dokumen" id="nama_dokumen" value="{{$surat_tugas_penelitian->nama_dokumen}}" autocomplete="off">
                @error('nama_dokumen')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="perihal">Perihal</label>
                <input type="text" class="form-control @error('perihal') is-invalid @enderror" name="perihal" id="perihal" value="{{$surat_tugas_penelitian->perihal}}" autocomplete="off">
                @error('perihal')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="tanggal">Tanggal  <span style="color:red;" class="form-label">*</span></label>
                  <input class="form-control @error('tanggal') is-invalid @enderror" type="date" name="tanggal" id="tanggal" value="{{$surat_tugas_penelitian->tanggal}}">
                  @error('tanggal')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg">
                <div class="mb-3">
                  <label for="formFile">File</label>
                  <input class="form-control @error('file') is-invalid @enderror" name="file" type="file" id="formFile">
                  <sub>Pilih document hanya dengan format .pdf</sub>
                  <br>
                  <a target="_blank" href="{{ asset('berkas').'/'.$surat_tugas_penelitian->file }}"><i class="bx bx-file" ></i>  File yang ada</a>
                  @error('file')
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