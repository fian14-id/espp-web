@extends('_layouts.app')

@section('title', 'Entri Pembayaran')

@section('cssv')
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
<link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
<link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pembayaran /</span> Entri</h4>

<!-- DataTable with Buttons -->
<div class="card">
  <div class="card-datatable table-responsive pt-0">
    <table class="entrif table">
      <thead>
        <tr>
          <th></th>
          <th>NISN</th>
          <th>Nama</th>
          <th>SPP</th>
          <th>Nominal</th>
          <th>Status</th>
          <th>Kurang</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<div class="modal fade" id="modalBayar" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBayarTitle">Bayar SPP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="pt-0 row g-2" id="form-bayar" action="{{ route('pby.entri-post') }}" method="POST">
          @csrf
          <input type="hidden" id="idp" name="petugas" value="{{ auth()->guard('petugas')->user()->id_petugas }}">
          <input type="hidden" id="sspp" name="spp">
          <div class="col-md-6 mb-1">
            <label for="nsn" class="form-label">NISN</label>
            <input type="text" id="nsn" name="nisn" class="form-control" readonly>
          </div>
          <div class="col-md-6 mb-1">
            <label for="nma" class="form-label">Nama</label>
            <input type="text" id="nma" name="nama" class="form-control" readonly>
          </div>
          <div class="col-md-6 mb-1">
            <label for="nma" class="form-label">Tahun</label>
            <input type="text" id="sthn" name="thn" class="form-control" readonly>
          </div>
          <div class="col-md-6 mb-1">
            <label for="bln" class="form-label">Bulan</label>
            <select name="bulan[]" id="bln" class="select2 form-control" multiple>
            </select>
          </div>
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Bayar</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('jsv')
<script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="/assets/vendor/libs/select2/select2.js"></script>
<!-- Form Validation -->
<script src="/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
<script src="/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
<script src="/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
@endsection

@section('js')
<script src="/assets/js/pembayaran/entri.js"></script>
@endsection