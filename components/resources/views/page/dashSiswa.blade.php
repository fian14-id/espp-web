@extends('_layouts.app-siswa')

@section('title', 'Dasbor')

@section('content')
<div class="row">
  <div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">{{ \Helper::toIdr($total_bayar) }}</h5>
          <small>Total Bayar</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-success rounded-pill p-2">
            <i class='ti ti-report-money ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">{{ \Helper::toIdr($kurang) }}</h5>
          <small>Kurang</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-warning rounded-pill p-2">
            <i class='ti ti-file-minus ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">{{ $spp }}</h5>
          <small>SPP</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-primary rounded-pill p-2">
            <i class='ti ti-file-description ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">{{ \Helper::toIdr($tSpp) }}</h5>
          <small>Total SPP</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-info rounded-pill p-2">
            <i class='ti ti-receipt-2 ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection