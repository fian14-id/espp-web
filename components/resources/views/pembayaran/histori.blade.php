@extends('_layouts.app')

@section('title', 'Histori Pembayaran')

@section('cssv')
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pembayaran /</span> Histori</h4>

<!-- DataTable with Buttons -->
<div class="card">
  <div class="card-datatable table-responsive pt-0">
    <table class="historyf table">
      <thead>
        <tr>
          <th></th>
          <th>Petugas</th>
          <th>Bulan</th>
          <th>Tahun</th>
          <th>Jumlah</th>
          <th>Date</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection

@section('jsv')
<script src="/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
@endsection

@section('js')
<script src="/assets/js/pembayaran/history.js"></script>
@endsection