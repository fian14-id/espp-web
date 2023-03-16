@extends('_layouts.app')

@section('title', 'Dasbor')

@section('cssv')
<link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />
@endsection

@section('content')
<div class="row">
  <div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">{{ $tSiswa }}</h5>
          <small>Total Siswa</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-primary rounded-pill p-2">
            <i class='ti ti-users ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">{{ $tKelas }}</h5>
          <small>Total Kelas</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-info rounded-pill p-2">
            <i class='ti ti-school ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div class="card-title mb-0">
          <h5 class="mb-0 me-2">{{ $tSpp }}</h5>
          <small>Total SPP</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-success rounded-pill p-2">
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
          <h5 class="mb-0 me-2">{{ $tPetugas }}</h5>
          <small>Total Petugas</small>
        </div>
        <div class="card-icon">
          <span class="badge bg-label-secondary rounded-pill p-2">
            <i class='ti ti-user-circle ti-sm'></i>
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <div class="card-title m-0">
          <h5 class="mb-0">Laporan Pembayaran</h5>
          <small class="text-muted">Ikhtisar pembayran awal</small>
        </div>
        <div class="dropdown">
          <button type="button" class="btn dropdown-toggle p-0" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ti ti-calendar"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Hari Ini</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="card-body">
        <div id="earningReportsTabsOrders"></div>
      </div>
    </div>
  </div>
     
</div>
@endsection

@section('jsv')
<script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>
@endsection

@section('js')
<script src="/assets/js/dash.petugas.js"></script>
@endsection