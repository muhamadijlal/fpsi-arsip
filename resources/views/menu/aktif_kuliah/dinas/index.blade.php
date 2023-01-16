@extends('master.index')
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"/>
@endpush
@section('title',Auth::user()->role != 'tu' ? Breadcrumbs::render('aktifKuliah.Mahasiswa.dinas') : Breadcrumbs::render('aktifKuliah.Tu.dinas'))

@section('content')

@php
  $collection = App\Models\Ms_aktifKuliah::where('nim', Auth::user()->nim)->where('jenis_surat','dinas')->where('deleted_at', null)->first();
@endphp

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
      <h5 class="card-title">Tabel data Aktif Kuliah Dinas</h5>
      {{-- <div class="card-subtitle text-muted mb-3">Card subtitle</div> --}}
      <a href="{{ Auth::user()->role != 'mahasiswa' ? route('tu.dinas_aktif_kuliah_create') : route('mahasiswa.dinas_aktif_kuliah_create') }}" class="btn btn-md btn-outline-primary mb-4 {{ $collection ? 'd-none' : '' }} ">
        <span class="tf-icons bx bx-plus-medical"></span>&nbsp; Aktif Kuliah Dinas
      </a>
      <table id="example" class="table table-hover table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th></th>
                <th>Aksi</th>
                <th>Nomor Dokumen</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Semester</th>
                <th>Jenjang</th>
                <th>Kota Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Nama Orang Tua</th>
                <th>Instansi</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Pangkat / Golongan</th>
                <th>Keperluan</th>
                <th>Tanggal Pembuatan</th>
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
      ajax: "{{ Auth::user()->role != 'mahasiswa' ? route('tu.dinas_dataTable.aktif_kuliah') : route('mahasiswa.dinas_dataTable.aktif_kuliah')}}",
      columns: [
        {data: '', name: ''},
        {data: 'aksi', name: 'aksi'},
        {data: 'nomor_dokumen', name: 'nomor_dokumen'},        
        {data: 'nama', name: 'nama'},        
        {data: 'nim', name: 'nim'},        
        {data: 'semester', name: 'semester'},        
        {data: 'jenjang', name: 'jenjang'},        
        {data: 'kota_lahir', name: 'kota_lahir'},        
        {data: 'tanggal_lahir', name: 'tanggal_lahir'},        
        {data: 'alamat', name: 'alamat'},        
        {data: 'nama_orangtua', name: 'nama_orangtua'},        
        {data: 'instansi_orangtua', name: 'instansi_orangtua'},        
        {data: 'nip_orangtua', name: 'nip_orangtua'},        
        {data: 'jabatan', name: 'jabatan'},        
        {data: 'pangkat_golongan', name: 'pangkat_golongan'},        
        {data: 'keperluan', name: 'keperluan'},        
        {data: 'tanggal_upload', name: 'tanggal_upload'},
      ]
    });
  });
</script>

@if(Auth::user()->email != 'mahasiswa')
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
        window.location.href = ("/tu/aktif/kuliah/dinas/delete/"+data_id);
        } else {
        swal("Deleting Canceled");
        }
    });
}
</script>
@endif
@endpush