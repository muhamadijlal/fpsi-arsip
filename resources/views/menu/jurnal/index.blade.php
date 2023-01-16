@extends('master.index')
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"/>
@endpush
{{-- @section('title',Breadcrumbs::render('jurnal')) --}}


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
      <h5 class="card-title">Tabel Jurnal</h5>
      {{-- <div class="card-subtitle text-muted mb-3">Card subtitle</div> --}}
      <a href="{{ Auth::user()->role == 'kepala' ? route('kepala.jurnal_create') : route('root.jurnal_create') }}" class="btn btn-md btn-outline-primary mb-4">
        <span class="tf-icons bx bx-plus-medical"></span>&nbsp; Jurnal
      </a>
      <table id="example" class="table table-hover table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th></th>
                <th>Aksi</th>
                <th>Nama Dokumen</th>
                <th>Perihal</th>
                <th>Tahun Akademik</th>
                <th>Tanggal dibuat</th>
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
      ajax: "{{ Auth::user()->role == 'kepala' ? route('kepala.dataTable.jurnal') :  route('root.dataTable.jurnal') }}",
      columns: [
        {data: '', name: ''},
        {data: 'aksi', name: 'aksi'},
        {data: 'nama_dokumen', name: 'nama_dokumen'},      
        {data: 'perihal', name: 'perihal'},
        {data: 'tahun_akademik', name: 'tahun_akademik'},
        {data: 'tanggal_upload', name: 'tanggal_upload'},     
      ]
    });
  });
</script>

@if(Auth::user()->role == 'kepala')
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
          window.location.href = ("/kepala/jurnal/delete/"+data_id);
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
          window.location.href = ("/root/jurnal/delete/"+data_id);
          } else {
          swal("Deleting Canceled");
          }
      });
  }
  </script>
@endif
@endpush