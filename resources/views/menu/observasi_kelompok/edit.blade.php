@extends('master.index')

@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('mahasiswa/observasi/kelompok.edit', $observasi_kelompok) : Breadcrumbs::render('tu/observasi/kelompok.edit', $observasi_kelompok))


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role != 'mahasiswa' ? route('tu.observasi_kelompok_update', $observasi_kelompok->id) : route('mahasiswa.observasi_kelompok_update', $observasi_kelompok->id) }}" method="post">
          @method('PUT')
          @csrf

          @if (Auth::user()->role != 'mahasiswa')
          <div class="mb-3">
            <label for="nomor_dokumen">Nomor Dokumen <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" name="nomor_dokumen" id="nomor_dokumen" value="{{ $observasi_kelompok->nomor_dokumen }}" autocomplete="off">
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
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ $observasi->nama  }}" autocomplete="off">
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
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ $observasi->nim  }}" autocomplete="off">
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
            <input type="text" class="form-control @error('pengampu') is-invalid @enderror" name="pengampu" id="pengampu" value="{{ $observasi_kelompok->pengampu }}" autocomplete="off">
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
              <option {{  $observasi_kelompok->semester == 'I (Satu)' ? 'selected' : '' }} value="I (Satu)">I (Satu)</option>
              <option {{  $observasi_kelompok->semester == 'II (Dua)' ? 'selected' : '' }} value="II (Dua)">II (Dua)</option>
              <option {{  $observasi_kelompok->semester == 'III (Tiga)' ? 'selected' : '' }} value="III (Tiga)">III (Tiga)</option>
              <option {{  $observasi_kelompok->semester == 'IV (Empat)' ? 'selected' : '' }} value="IV (Empat)">IV (Empat)</option>
              <option {{  $observasi_kelompok->semester == 'V (Lima)' ? 'selected' : '' }} value="V (Lima)">V (Lima)</option>
              <option {{  $observasi_kelompok->semester == 'VI (Enam)' ? 'selected' : '' }} value="VI (Enam)">VI (Enam)</option>
              <option {{  $observasi_kelompok->semester == 'VII (Tujuh)' ? 'selected' : '' }} value="VII (Tujuh)">VII (Tujuh)</option>
              <option {{  $observasi_kelompok->semester == 'VIII (Delapan)' ? 'selected' : '' }} value="VIII (Delapan)">VIII (Delapan)</option>
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
                <input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" id="tempat" value="{{ $observasi_kelompok->tempat }}" autocomplete="off">
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
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{ $observasi_kelompok->alamat }}" autocomplete="off">
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
            <input type="text" class="form-control @error('agenda') is-invalid @enderror" name="agenda" id="agenda" value="{{ $observasi_kelompok->agenda }}" autocomplete="off">
            @error('agenda')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="tanggal">Tanggal Pelaksanaan <span style="color:red;" class="form-label">*</span></label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{ $observasi_kelompok->tanggal }}" autocomplete="off">
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
              <option {{  $observasi_kelompok->jenis  == 'observasi' ? 'selected' : '' }} value="observasi">Observasi</option>
              <option {{  $observasi_kelompok->jenis  == 'wawancara' ? 'selected' : '' }} value="wawancara">Wawancara</option>
              <option {{  $observasi_kelompok->jenis  == 'survei' ? 'selected' : '' }} value="survei">Survei</option>
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