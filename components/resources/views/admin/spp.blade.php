@extends('_layouts.app')

@section('title', 'Daftar SPP')

@section('cssv')
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
<link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Daftar SPP</h4>

<!-- DataTable with Buttons -->
<div class="card">
  <div class="card-datatable table-responsive pt-0">
    <table class="sppf table">
      <thead>
        <tr>
          <th></th>
          <th>Tahun</th>
          <th>Nominal</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!-- Modal to add Tambah Petugs -->
<div class="offcanvas offcanvas-end" id="tambah-spp">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="exampleModalLabel">Tambah SPP</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form class="tambah-spp pt-0 row g-2" id="form-tambah-spp" onsubmit="return false">
      @csrf
      <input type="hidden" name="fid" id="fid">
      <div class="col-sm-12">
        <label class="form-label" for="tahun">Tahun</label>
        <div class="input-group input-group-merge">
          <span id="ficn" class="input-group-text"><i class="ti ti-calendar-time"></i></span>
          <input type="number" id="tahun" class="form-control dt-tahun" name="tahun" placeholder="2023" aria-label="2023" aria-describedby="ficn" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="nominal">Nominal Per Bulan</label>
        <div class="input-group input-group-merge">
          <span id="nmic" class="input-group-text"><i class="ti ti-currency-dollar"></i></span>
          <input type="number" id="nominal" name="nominal" class="form-control dt-nominal" placeholder="100.000" aria-label="10000" aria-describedby="nmic" />
        </div>
      </div>
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Kirim</button>
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
      </div>
    </form>
  </div>
</div>
<!--/ DataTable with Buttons -->
@endsection

@section('jsv')
<script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<!-- Form Validation -->
<script src="/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
<script src="/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
<script src="/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
@endsection

@section('js')
<script src="/assets/js/admin/spp.js"></script>
@endsection