@extends('master.index')

@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('mahasiswa/observasi.create') : Breadcrumbs::render('tu/observasi.create'))


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role != 'mahasiswa' ? route('tu.observasi_store') : route('mahasiswa.observasi_store') }}" method="post">
          @csrf

          @if(Auth::user()->role == 'mahasiswa')
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="nama">Nama Lengkap Mahasiswa <span style="color:red;" class="form-label">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ Auth::user()->nama  }}" autocomplete="off" readonly>
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
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ Auth::user()->nim }}" autocomplete="off" readonly>
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
                <label for="lokasi">Lokasi <span style="color:red;" class="form-label">*</span></label>
                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" value="{{old('lokasi')}}" autocomplete="off">
                @error('lokasi')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-lg">
              <div class="mb-3">
                <label for="kecamatan">Kecamatan <span style="color:red;" class="form-label">*</span></label>
                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" value="{{old('kecamatan')}}" autocomplete="off">
                @error('kecamatan')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="judul">Judul/Tema <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{old('judul')}}" autocomplete="off">
            @error('judul')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="jenis">Jenis Observasi <span style="color:red;" class="form-label">*</span></label>
            <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
              <option value="">-- Pilih --</option>
              <option {{ old('jenis') == 'pra penelitian' ? 'selected' : '' }} value="pra penelitian">Pra Penelitian</option>
              <option {{ old('jenis') == 'penelitian' ? 'selected' : '' }} value="penelitian">Penelitian</option>
              <option {{ old('jenis') == 'observasi' ? 'selected' : '' }} value="observasi">Observasi</option>
              <option {{ old('jenis') == 'try out' ? 'selected' : '' }} value="try out">Try out</option>
            </select>
            @error('jenis')
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