@extends('master.index')

{{-- @section('title',Breadcrumbs::render('jurnal.history', $id)) --}}

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@section('content')

<a href="{{ Auth::user()->role == 'kepala' ? route('kepala.jurnal_history_create', $id) : route('root.jurnal_history_create', $id) }}" class="btn btn-md btn-outline-primary mb-4">
  <span class="tf-icons bx bx-plus-medical"></span>&nbsp; History
</a>

@if (session()->has('pesan'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session()->get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="row overflow-hidden">
  <div class="col-12">
    <ul class="timeline timeline-center mt-5">
      @forelse ($histories as $history)
      <li class="timeline-item mb-md-4 mb-5">
        <span class="timeline-indicator timeline-indicator-primary" data-aos="zoom-in" data-aos-duration="500">
          <i class="bx bx-git-repo-forked"></i>
        </span>
        <div class="timeline-event card p-0" data-aos="fade-up" data-aos-duration="1000">
          <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h6 class="card-title mb-0">{{ $history->pengirim }}</h6>
            <div class="meta">
              <span class="badge rounded-pill bg-label-primary">{{ $history->created_at->format('h:i:s') }}</span>
            </div>
          </div>
          <div class="card-body">
            <p class="mb-2">
              {{ $history->catatan }}
            </p>
          </div>
          <div class="timeline-event-time">{{ $history->created_at->format('(d-M-Y)') }}</div>
        </div>
      </li>
      @empty
        <h1 class="d-flex justify-content-center align-items-center">No History Yet.</h1>
      @endforelse
    </ul>
  </div>
</div>

@endsection

@push('js')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
@endpush