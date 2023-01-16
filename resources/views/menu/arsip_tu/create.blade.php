@extends('master.index')

@section('title',Breadcrumbs::render('arsipTu.create'))


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ route('tu.arsip_store') }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
              <label for="nama_dokumen">Nama Dokumen<span style="color:red;" class="form-label">*</span></label>
              <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror" name="nama_dokumen" id="nama_dokumen" value="{{old('nama_dokumen')}}" autocomplete="off">
              @error('nama_dokumen')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
          </div>

          <div class="mb-3">
              <label for="perihal">Perihal</label>
              <input type="text" class="form-control @error('perihal') is-invalid @enderror" name="perihal" id="perihal" value="{{old('perihal')}}" autocomplete="off">
              @error('perihal')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
          </div>    

          <div class="col-lg">
            <div class="mb-3">
              <label for="formFile">File<span style="color:red;" class="form-label"> *</span></label>
              <input class="form-control @error('file') is-invalid @enderror" name="file" type="file" id="formFile">
              <sub>Pilih document hanya dengan format .pdf</sub>
              @error('file')
                <div class="text-danger">
                  {{ $message }}
                </div>
              @enderror
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