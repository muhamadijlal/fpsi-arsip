@extends('master.index')

{{-- @section('title', Breadcrumbs::render('jurnal.history.create', $jurnal)) --}}


@section('content')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <form action="{{ Auth::user()->role == 'kepala' ? route('kepala.jurnal_history_store',$jurnal->id) :  route('root.jurnal_history_store',$jurnal->id) }}" method="post">
          @csrf

          <div class="mb-3">
            <label for="catatan">Catatan <span style="color:red;" class="form-label">*</span></label>
            <input type="text" class="form-control @error('catatan') is-invalid @enderror" name="catatan" id="catatan" value="{{old('catatan')}}" autocomplete="off">
            @error('catatan')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
          </div>         
          
          <div class="mt-5">
            <label class="d-block text-dark py-2"><span style="color:red;">*</span> Wajib diisi</label>
            <button type="submit" class="btn btn-outline-success"> <i class="bx bx-upload"></i> Upload</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection