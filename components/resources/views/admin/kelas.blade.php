@extends('_layouts.app')

@section('title', 'Daftar Kelas')

@section('cssv')
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
<link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Daftar Kelas</h4>

<!-- DataTable with Buttons -->
<div class="card">
  <div class="card-datatable table-responsive pt-0">
    <table class="kelasf table">
      <thead>
        <tr>
          <th></th>
          <th>Kelas</th>
          <th>kompetensi Keahlian</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Modal to add Tambah Petugs -->
<div class="offcanvas offcanvas-end" id="tambah-kelas">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="mlbl">Tambah Kelas</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form class="tambah-kelas pt-0 row g-2" id="form-tambah-kelas" onsubmit="return false">
      @csrf
      <input type="hidden" name="fid" id="fid">
      <div class="col-sm-12">
        <label class="form-label" for="kls">Kelas</label>
        <div class="input-group input-group-merge">
          <span id="klsf" class="input-group-text"><i class="ti ti-signature"></i></span>
          <select name="kelas" id="kls" class="form-control dt-kelas" >
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
          </select>
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="jurusan">Jurusan</label>
        <div class="input-group input-group-merge">
          <span id="jrs" class="input-group-text"><i class="ti ti-badges"></i></span>
          <input type="text" id="jurusan" name="jurusan" class="form-control dt-jurusan" placeholder="Rekayasa Perangkat Lunak" aria-label="Rekayasa Perangkat Lunak" aria-describedby="jrsn" />
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
<script src="/assets/js/admin/kelas.js"></script>
@endsection