@extends('master.index')
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"/>
@endpush
@section('title', Auth::user()->role != 'tu' ? Breadcrumbs::render('dosenTamu') : Breadcrumbs::render('tu/dosenTamu'))

@section('content')
@if (session()->has('pesan'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session()->get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="col-lg-12 mt-3">
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title">Tabel data Surat Kunjungan Dosen Tamu</h5>
      <a href="{{ Auth::user()->role != 'dosen' || Auth::user()->role == 'root' ? route('tu.dosen_tamu_create') : route('dosen.dosen_tamu_create') }}" class="btn btn-md btn-outline-primary mb-4">
        <span class="tf-icons bx bx-plus-medical"></span>&nbsp; Surat Kunjungan Dosen Tamu
      </a>
      <table id="example" class="table table-hover table-striped" style="width: 100%;">
        <thead>
            <tr>
              <th></th>
              <th>Aksi</th>
              <th>Nomor Dokumen</th>
              <th>Nama Pemohon</th>
              <th>Nama Lengkap & Gelar Dosen Tamu</th>
              <th>Intansi Dosen Tamu</th>
              <th>Mata Kuliah</th>
              <th>Semester</th>
              <th>Tanggal Pelaksanaan</th>
              <th>Waktu Pelaksanaan</th>
              <th>Tempat Pelaksanaan</th>
              <th>Jenis Pelaksanaan</th>
            </tr>
        </thead>
    </table>
    </div>
  </div>
</div>

@endsection

@push('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(function () {
    let table = $('#example').DataTable({
      processing: true,
      serverSide: true,
      responsive: {
        details: {
          type: 'column'
        }
      },
      columnDefs: [{
        className: 'dtr-control',
        orderable: false,
        targets:   0
      }],
      ajax: "{{ Auth::user()->role != 'dosen' ? route('tu.dataTable.dosen_tamu') : route('dosen.dataTable.dosen_tamu') }}",
      columns: [
        {data: '', name: ''},
        {data: 'aksi', name: 'aksi'},
        {data: 'nomor_dokumen', name: 'nomor_dokumen'},
        {data: 'pemohon', name: 'pemohon'},
        {data: 'nama_lengkap_gelar', name: 'nama_lengkap_gelar'},        
        {data: 'instansi', name: 'instansi'},        
        {data: 'mata_kuliah', name: 'mata_kuliah'},        
        {data: 'semester', name: 'semester'},        
        {data: 'tanggal', name: 'tanggal'},        
        {data: 'waktu', name: 'waktu'},
        {data: 'tempat', name: 'tempat'},
        {data: 'jenis_pelaksanaan', name: 'jenis_pelaksanaan'},
      ]
    });
  });
</script>

@if(Auth::user()->role != 'dosen')

<script>
function confirmDelete(data_id) {
    swal({
        title: "Delete Report ?",
        text: "Data "+ data_id +" will permanently deleted!",
        icon: "warning",
        buttons: true,  
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
        window.location.href = ("/tu/dosen/tamu/delete/"+data_id);
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
          text: "Data "+ data_id +" will permanently deleted!",
          icon: "warning",
          buttons: true,  
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
          window.location.href = ("dosen/penunjang/dosen/tamu/delete/"+data_id);
          } else {
          swal("Deleting Canceled");
          }
      });
  }
  </script>

@endif

@endpush