@extends('_layouts.app')

@section('title', 'Daftar Petugas')

@section('cssv')
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
<link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Daftar Petugas</h4>

<!-- DataTable with Buttons -->
<div class="card">
  <div class="card-datatable table-responsive pt-0">
    <table class="petugasf table">
      <thead>
        <tr>
          <th></th>
          <th>Nama</th>
          <th>Username</th>
          <th>Password</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Modal to add Tambah Petugs -->
<div class="offcanvas offcanvas-end" id="tambah-petugas">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Petugas</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form class="tambah-petugas pt-0 row g-2" id="form-tambah-petugas" onsubmit="return false">
      @csrf
      <input type="hidden" name="fid" id="fid">
      <div class="col-sm-12">
        <label class="form-label" for="name">Nama</label>
        <div class="input-group input-group-merge">
          <span id="nmae2" class="input-group-text"><i class="ti ti-signature"></i></span>
          <input type="text" id="name" class="form-control dt-name" name="name" placeholder="John Doe" aria-label="John Doe" aria-describedby="nmae2" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="usrnm">Username</label>
        <div class="input-group input-group-merge">
          <span id="usrn" class="input-group-text"><i class="ti ti-user"></i></span>
          <input type="text" id="usrnm" name="usrnm" class="form-control dt-usr" placeholder="famigtg" aria-label="famigtg" aria-describedby="usrn" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="pass">Password</label>
        <div class="input-group input-group-merge">
          <span id="pw2" class="input-group-text"><i class="ti ti-key"></i></span>
          <input type="text" id="pass" name="pass" class="form-control dt-pass" placeholder="fam123" aria-label="fam123" aria-describedby="pw2" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="lvl">Level</label>
        <div class="input-group input-group-merge">
          <span id="pw2" class="input-group-text"><i class="ti ti-select"></i></span>
          <select class="form-control dt-level" name="level" id="lvl">
            <option value="petugas">Petugas</option>
            <option value="admin">Admin</option>
          </select>
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
<script src="/assets/js/admin/petugas.js"></script>
@endsection