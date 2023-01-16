@extends('master.index')

@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('mahasiswa/observasi/kelompok.create') : Breadcrumbs::render('tu/observasi/kelompok.create'))


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role != 'mahasiswa' ? route('tu.observasi_kelompok_store') : route('mahasiswa.observasi_kelompok_store') }}" method="post">
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
            <label for="pengampu">Nama Lengkap dan Gelar Dosen Pengampu <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('pengampu') is-invalid @enderror" name="pengampu" id="pengampu" value="{{old('pengampu')}}" autocomplete="off">
            @error('pengampu')
            <div class="text-danger">
              {{ $message }}
            </div>
            @enderror
          </div>

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
                <label for="tempat">Tempat Observasi<span style="color:red;" class="form-label">*</span></label>
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
                <label for="alamat">Alamat <span style="color:red;" class="form-label">*</span></label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{old('alamat')}}" autocomplete="off">
                @error('alamat')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="agenda">Agenda/Tema/Judul <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('agenda') is-invalid @enderror" name="agenda" id="agenda" value="{{old('agenda')}}" autocomplete="off">
            @error('agenda')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="tanggal">Tanggal Pelaksanaan <span style="color:red;" class="form-label">*</span></label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}" autocomplete="off">
            @error('tanggal')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="jenis">Jenis Observasi <span style="color:red;" class="form-label">*</span></label>
            <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
              <option value="">-- Pilih --</option>
              <option {{ old('jenis') == 'observasi' ? 'selected' : '' }} value="observasi">Observasi</option>
              <option {{ old('jenis') == 'wawancara' ? 'selected' : '' }} value="wawancara">Wawancara</option>
              <option {{ old('jenis') == 'survei' ? 'selected' : '' }} value="survei">Survei</option>
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