@extends('master.index')
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"/>
@endpush
@section('title', Auth::user()->role != 'tu' ?  Breadcrumbs::render('konseling') :  Breadcrumbs::render('tu/konseling'))


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
      <h5 class="card-title">Tabel data Konseling</h5>
      {{-- <div class="card-subtitle text-muted mb-3">Card subtitle</div> --}}
      <a href="{{ Auth::user()->role != 'dosen' ? route('tu.konseling_create') : route('dosen.konseling_create') }}" class="btn btn-md btn-outline-primary mb-4">
        <span class="tf-icons bx bx-plus-medical"></span>&nbsp; Konseling
      </a>
      <table id="example" class="table table-hover table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th></th>
                <th>Aksi</th>
                <th>Nomor Dokumen</th>
                <th>Nama Dokumen</th>
                <th>Perihal</th>
                <th>Tanggal Awal Pelaksanaan</th>
                <th>Tanggal Akhir Pelaksanaan</th>
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
      ajax: "{{ Auth::user()->role != 'dosen' ? route('tu.dataTable.konseling') : route('dosen.dataTable.konseling') }}",
      columns: [
        {data: '', name: ''},
        {data: 'aksi', name: 'aksi'},
        {data: 'nomor_dokumen', name: 'nomor_dokumen'},
        {data: 'nama_dokumen', name: 'nama_dokumen'},              
        {data: 'perihal', name: 'perihal'},        
        {data: 'tanggal_awal', name: 'tanggal_awal'},        
        {data: 'tanggal_akhir', name: 'tanggal_akhir'},        
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
        window.location.href = ("/tu/konseling/delete/"+data_id);
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
          window.location.href = ("/dosen/penunjang/konseling/delete/"+data_id);
          } else {
          swal("Deleting Canceled");
          }
      });
  }
  </script>

@endif

@endpush