@extends('master.index')

@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('aktifKuliah.Mahasiswa.umum.create') : Breadcrumbs::render('aktifKuliah.Tu.umum.create'))


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role != 'mahasiswa' ? route('tu.umum_aktif_kuliah_store') : route('mahasiswa.umum_aktif_kuliah_store') }}" method="post">
          @csrf

          @if(Auth::user()->role == 'tu')
            <div class="mb-3">
              <label for="nomor_dokumen">Nomor Dokumen <span style="color:red;" class="form-label">*</span></label>
              <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" name="nomor_dokumen" id="nomor_dokumen" value="{{ old('nomor_dokumen') }}" autocomplete="off">
              @error('nomor_dokumen')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
          @endif

          @if(Auth::user()->role == 'mahasiswa')
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="nama">Nama Lengkap Mahasiswa <span style="color:red;" class="form-label">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ Auth::user()->nama }}" autocomplete="off" readonly>
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
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ Auth::user()->nim  }}" autocomplete="off" readonly>
                @error('nim')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          @else
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="nama">Nama Lengkap Mahasiswa <span style="color:red;" class="form-label">*</span></label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{old('nama')}}" autocomplete="off">
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
                  <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{old('nim')}}" autocomplete="off">
                  @error('nim')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
          @endif

          <div class="mb-3">
            <label for="semester">Semester <span style="color:red;">*</span></label>
            <select class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester">
              <option value="">-- Pilih --</option>
              <option {{ old('semester') == 'I (Satu)' ? 'selected' : '' }} value="I (Satu)">I (Satu)</option>
              <option {{ old('semester') == 'II (Dua)' ? 'selected' : '' }} value="II (Dua)">II (Dua)</option>
              <option {{ old('semester') == 'III (Tiga)' ? 'selected' : '' }} value="III (Tiga)">III (Tiga)</option>
              <option {{ old('semester') == 'IV (Empat)' ? 'selected' : '' }} value="IV (Empat)">IV (Empat)</option>
              <option {{ old('semester') == 'V (Lima)' ? 'selected' : '' }} value="V (Lima)">V (Lima)</option>
              <option {{ old('semester') == 'VI (Enam)' ? 'selected' : '' }} value="VI (Enam)">VI (Enam)</option>
              <option {{ old('semester') == 'VII (Tujuh)' ? 'selected' : '' }} value="VII (Tujuh)">VII (Tujuh)</option>
              <option {{ old('semester') == 'VIII (Delapan)' ? 'selected' : '' }} value="VIII (Delapan)">VIII (Delapan)</option>
            </select>
            @error('semester')
            <div class="text-danger">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="tanggal_lahir">Tanggal Lahir <span style="color:red;" class="form-label">*</span></label>
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{old('tanggal_lahir')}}" autocomplete="off">
                @error('tanggal_lahir')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
            <div class="col-lg">
              <div class="mb-3">
                <label for="kota_lahir">Kota lahir <span style="color:red;" class="form-label">*</span></label>
                <input type="text" class="form-control @error('kota_lahir') is-invalid @enderror" name="kota_lahir" id="kota_lahir" value="{{old('kota_lahir')}}" autocomplete="off">
                @error('kota_lahir')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="keperluan">Keperluan <span style="color:red;" class="form-label">*</span></label>
            <select class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan">
              <option value="">-- Pilih --</option>
              <option {{ old('keperluan') == 'beasiswa karawang cerdas' ? 'selected' : '' }} value="beasiswa karawang cerdas">Beasiswa Karawang Cerdas</option>
              <option {{ old('keperluan') == 'umum' ? 'selected' : '' }} value="umum">Umum</option>
            </select>
            @error('keperluan')
              <div class="text-danger">
                {{ $message }}
              </div>
            @enderror
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