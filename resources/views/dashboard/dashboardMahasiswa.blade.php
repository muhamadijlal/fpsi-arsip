@extends('master.index')

@section('title','Dashboard')

@section('content')

<!-- Contact -->
<div class="row mt-5">
  <div class="col-12 text-center mb-4">
    <div class="badge bg-label-primary">Pertanyaan ?</div>
    <h4 class="my-2">Anda punya pertanyaan ?</h4>
  </div>
</div>
<div class="row text-center justify-content-center gap-sm-0 gap-3">
  <div class="col-sm-6">
    <div class=" py-3 rounded bg-faq-section text-center">
      <span class="badge bg-label-primary rounded-2 my-3">
        <i class="bx bx-phone bx-sm"></i>
      </span>
      <h4 class="mb-2"><a class="h4" href="tel:+(810)25482568">+ (810) 2548 2568</a></h4>
      <p>Nomor Pelayanan Tata Usaha Fakultas Psikologi</p>
    </div>
  </div>
  <div class="col-sm-6">
    <div class=" py-3 rounded bg-faq-section text-center">
      <span class="badge bg-label-primary rounded-2 my-3">
        <i class="bx bx-envelope bx-sm"></i>
      </span>
      <h4 class="mb-2"><a class="h4" href="mailto:help@help.com">help@help.com</a></h4>
      <p>Email Pelayanan Fakultas Psikologi</p>
    </div>
  </div>
</div>
<!-- /Contact -->
@endsection