@extends('master.index')

@section('title','Dashboard')

@section('content')
<div class="row">
  <div class="col-lg-6 col-md-12 col-12 mb-4">
    <div class="card mb-lg-0 mb-4">
      <div class="card-body text-center">
        <h2>
          <i class="bx bx-user text-primary display-6"></i>
        </h2>
        <h4>Users</h4>
        <h5>{{ $users }}</h5>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left  col-12 text-truncate">
                <span>Total Dosen</span>
                <div class="d-flex align-items-end mt-2">
                  <h4 class="mb-0 me-2">{{ $dosen }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="content-left col-12 text-truncate">
                <span>Total Mahasiswa</span>
                <div class="d-flex align-items-end mt-2">
                  <h4 class="mb-0 me-2">{{ $mahasiswa }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</div>
@endsection