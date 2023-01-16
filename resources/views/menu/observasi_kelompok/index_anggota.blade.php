@extends('master.index')
@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('mahasiswa/observasi/kelompok.add', $observasi_kelompok) : Breadcrumbs::render('tu/observasi/kelompok.add', $observasi_kelompok))


@section('content')

@if (session()->has('pesan'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session()->get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @elseif($errors->any())
  <div class="alert alert-danger alert-dismissible">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="col-lg-12 mt-3">
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title">Observasi Kelompok</h5>
      <table class="table table-hover table-bordered text-center" style="width: 100%;">
        <thead>
            <tr>
              <th>Nama</th>
              <th>NIM</th>
              <th>Agenda/Judul/Tema</th>
              <th>Dosen Pengampu</th>
              <th>Lokasi Observasi</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $observasi_kelompok->nama }}</td>
            <td>{{ $observasi_kelompok->nim }}</td>
            <td>{{ $observasi_kelompok->agenda }}</td>
            <td>{{ $observasi_kelompok->pengampu }}</td>
            <td>{{ $observasi_kelompok->tempat }}</td>
          </tr>
        </tbody>
      </table>
      <div class="mt-5">
        <h5>Daftar Anggota Observasi</h5>
        <table class="table table-hover table-bordered text-center" style="width: 100%;">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>NIM</th>
              <th>Aksi</th>
            </tr>
            <tbody>
              @forelse ($observasi_kelompok->anggota_observasi_kelompok as $anggota)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $anggota->nama }}</td>
                  <td>{{ $anggota->nim }}</td>
                  <td>
                    <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete({{ $anggota->id }})"><i class="tf-icons bx bx-trash"></i></button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4">{{ $observasi_kelompok->nama }} belum memiliki anggota!</td>
                </tr>
              @endforelse
            </tbody>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <form action="{{ Auth::user()->role != 'mahasiswa' ? route("tu.anggota.observasi_kelompok_store",$observasi_kelompok->id) : route("mahasiswa.anggota.observasi_kelompok_store",$observasi_kelompok->id) }}" method="POST">
        @csrf
        <button id="addField" type="button" class="btn btn-outline-primary rounded-pill"> <i class="bx bx-plus-medical"></i> Tambah Anggota</button>
          <div id="inputField">
            <div class="row my-4">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nama">Nama Lengkap Mahasiswa <span style="color:red;">*</span></label>
                  <input type="text" class="form-control" name="nama[]" id="nama" autocomplete="off">                                       
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for="nim">NIM <span style="color:red;">*</span></label>
                  <input type="text" class="form-control" name="nim[]" id="nim" autocomplete="off">
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-outline-success"> <i class="bx bx-upload"></i> Upload</button>
      </form>
    </div>
</div>
</div>

@endsection

@push('js')
<script>
  // add field
  $("#addField").click(function () {
    let html = '';      

    html += '<div class="row my-4 align-items-end" id="rowInputAdd">';
    html += '<div class="col-lg-6">';
    html += '<div class="form-group">';
    html += '<label for="nama">Nama Lengkap Mahasiswa <span style="color:red;">*</span></label>';
    html += '<input type="text" class="form-control" name="nama[]" id="nama" autocomplete="off">';
    html += '</div>';
    html += '</div>';
    // 
    html += '<div class="col-lg-5">';
    html += '<div class="form-group">';
    html += '<label for="nim">NIM <span style="color:red;">*</span></label>';
    html += '<input type="text" class="form-control" name="nim[]" id="nim" autocomplete="off">';
    html += '</div>';
    html += '</div>';
    
    html += '<div class="col-auto">';
    html += '<span class="btn btn-icon btn-md btn-outline-danger" id="deleteRowInput"><i class="tf-icons bx bx-trash"></i></span>';       
    html += '</div>';
    html += '</div>';
    
    $('#inputField').append(html);
  });

  // remove row
  $(document).on('click', '#deleteRowInput', function () {
    $(this).closest('#rowInputAdd').remove();
  });
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(Auth::user()->role != 'mahasiswa')
<script>
  function confirmDelete(data_id) {
    swal({
      title: "Delete Report ?",
      text: "Data "+ data_id +" will deleted!",
      icon: "warning",
      buttons: true,  
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = ("/tu/observasi_kelompok/anggota/"+data_id+"/delete");
      } else {
        swal("Deleting Canceled");
      }
    });
  }
</script>
@else
<script>
  function confirmDelete(data_id) {
    swal({
      title: "Delete Report ?",
      text: "Data "+ data_id +" will deleted!",
      icon: "warning",
      buttons: true,  
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = ("/mahasiswa/observasi_kelompok/anggota/"+data_id+"/delete");
      } else {
        swal("Deleting Canceled");
      }
    });
  }
</script>
@endif
@endpush