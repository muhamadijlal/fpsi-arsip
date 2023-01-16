@extends('master.index')

@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('mahasiswa/suratIzin.edit', $surat_izin) : Breadcrumbs::render('tu/suratIzin.edit', $surat_izin))


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role != 'mahasiswa' ? route('tu.surat_izin_update', $surat_izin->id) : route('mahasiswa.surat_izin_update', $surat_izin->id) }}" method="post">
          @method('PUT')
          @csrf

          @if(Auth::user()->role == 'tu')
          <div class="mb-3">
            <label for="nomor_dokumen">Nomor Dokumen <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" name="nomor_dokumen" id="nomor_dokumen" value="{{ $surat_izin->nomor_dokumen }}" autocomplete="off">
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
                <input type="text" class="form-control" name="nama" id="nama" value="{{ Auth::user()->nama }}" autocomplete="off" readonly>
              </div>
            </div>
            <div class="col-lg">
              <div class="mb-3">
                <label for="nim">NIM Mahasiswa <span style="color:red;" class="form-label">*</span></label>
                <input type="text" class="form-control" name="nim" id="nim" value="{{ Auth::user()->nim  }}" autocomplete="off" readonly>
              </div>
            </div>
          </div>
          @else
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="nama">Nama Lengkap Mahasiswa <span style="color:red;" class="form-label">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ $surat_izin->nama }}" autocomplete="off">
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
                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ $surat_izin->nim }}" autocomplete="off">
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
              <option {{ $surat_izin->semester  == 'I (Satu)' ? 'selected' : '' }} value="I (Satu)">I (Satu)</option>
              <option {{ $surat_izin->semester  == 'II (Dua)' ? 'selected' : '' }} value="II (Dua)">II (Dua)</option>
              <option {{ $surat_izin->semester  == 'III (Tiga)' ? 'selected' : '' }} value="III (Tiga)">III (Tiga)</option>
              <option {{ $surat_izin->semester  == 'IV (Empat)' ? 'selected' : '' }} value="IV (Empat)">IV (Empat)</option>
              <option {{ $surat_izin->semester  == 'V (Lima)' ? 'selected' : '' }} value="V (Lima)">V (Lima)</option>
              <option {{ $surat_izin->semester  == 'VI (Enam)' ? 'selected' : '' }} value="VI (Enam)">VI (Enam)</option>
              <option {{ $surat_izin->semester  == 'VII (Tujuh)' ? 'selected' : '' }} value="VII (Tujuh)">VII (Tujuh)</option>
              <option {{ $surat_izin->semester  == 'VIII (Delapan)' ? 'selected' : '' }} value="VIII (Delapan)">VIII (Delapan)</option>
            </select>
            @error('semester')
            <div class="text-danger">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="tujuan">Tujuan surat <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" id="tujuan" value="{{ $surat_izin->tujuan }}" autocomplete="off">
            @error('tujuan')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>

          <div class="row">
            <div class="col-lg-6">
              <label for="tanggal_awal">Tanggal mulai izin<span style="color:red;" class="form-label">*</span></label>
              <input type="date" class="form-control @error('tanggal_awal') is-invalid @enderror" name="tanggal_awal" id="tanggal_awal" value="{{ $surat_izin->tanggal_awal }}" autocomplete="off">
              @error('tanggal_awal')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-lg">
              <label for="tanggal_akhir">Tanggal selesai izin<span style="color:red;" class="form-label">*</span></label>
              <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir" id="tanggal_akhir" value="{{ $surat_izin->tanggal_akhir }}" autocomplete="off">
              @error('tanggal_akhir')
              <div class="text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="jenis">Jenis Izin <span style="color:red;" class="form-label">*</span></label>
            <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
              <option value="">-- Pilih --</option>
              <option {{ $surat_izin->jenis  == 'ujian tengah semester ganjil' ? 'selected' : '' }} value="ujian tengah semester ganjil">Ujian Tengah Semester Ganjil</option>
              <option {{ $surat_izin->jenis  == 'ujian tengah semester genap' ? 'selected' : '' }} value="ujian tengah semester genap">Ujian Tengah Semester Genap</option>
              <option {{ $surat_izin->jenis  == 'ujian akhir semester ganjil' ? 'selected' : '' }} value="ujian akhir semester ganjil">Ujian Akhir Semester Ganjil</option>
              <option {{ $surat_izin->jenis  == 'ujian akhir semester genap' ? 'selected' : '' }} value="ujian akhir semester genap">Ujian Akhir Semester Genap</option>
              <option {{ $surat_izin->jenis  == 'sidang tugas akhir' ? 'selected' : '' }} value="sidang tugas akhir">Sidang Tugas Akhir</option>
              <option {{ $surat_izin->jenis  == 'sidang kerja praktik' ? 'selected' : '' }} value="sidang kerja praktik">Sidang Kerja Praktik</option>
              <option {{ $surat_izin->jenis  == 'dispensasi' ? 'selected' : '' }} value="dispensasi">Dispensasi</option>
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