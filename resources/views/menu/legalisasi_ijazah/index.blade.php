@extends('master.index')
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"/>
@endpush
@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('legalisasiMahasiswa') : Breadcrumbs::render('legalisasiTu'))


@section('content')

@if (session('pesan'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session()->get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@elseif(session('error'))
  <div class="alert alert-danger alert-dismissible" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="col-lg-12 mt-3">
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title">Tabel data mahasiswa legalisasi ijazah</h5>
      {{-- <div class="card-subtitle text-muted mb-3">Card subtitle</div> --}}
      @if(Auth::user()->role != 'mahasiswa')
      <a href="{{ route('tu.legalisasi_print') }}" class="btn btn-md btn-outline-primary mb-4">
        <span class="tf-icons bx bx-printer"></span>&nbsp; Print rekap data legalisasi ijazah
      </a>
      @else
      <a href="{{ route('mahasiswa.legalisasi_create') }}" class="btn btn-md btn-outline-primary mb-4">
        <span class="tf-icons bx bx-plus-medical"></span>&nbsp; Ajukan dokumen legalisasi ijazah  
      </a>
      @endif
      <table id="example" class="table table-hover table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th></th>
                <th>Aksi</th>
                <th>Nomor Legalisasi</th>
                <th>Nomor Ijazah</th>
                <th>Nama</th>
                <th>Tahun Lulus</th>
                <th>Tanggal Lulus</th>
                <th>Keterangan</th>
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
      ajax: "{{ Auth::user()->role != 'mahasiswa' ? route('tu.dataTable.legalisasi') : route('mahasiswa.dataTable.legalisasi') }}",
      columns: [
        {data: '', name: ''},
        {data: 'aksi', name: 'aksi'},
        {data: 'nomor_legalisasi', name: 'nomor_legalisasi'},
        {data: 'nomor_ijazah', name: 'nomor_ijazah'},
        {data: 'nama', name: 'nama'},
        {data: 'tahun_lulus', name: 'tahun_lulus'},        
        {data: 'tanggal_lulus', name: 'tanggal_lulusl'},        
        {data: 'keterangan', name: 'keterangan'},        
      ]
    });
  });
</script>

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
        window.location.href = ("/tu/legalisasi/ijazah/delete/"+data_id);
        } else {
        swal("Deleting Canceled");
        }
    });
}
</script>
@endif

@endpush