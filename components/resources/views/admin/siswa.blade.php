@extends('_layouts.app')

@section('title', 'Daftar Siswa')

@section('cssv')
<link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
<link rel="stylesheet" href="/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
<link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Daftar Siswa</h4>

<!-- DataTable with Buttons -->
<div class="card">
  <div class="card-datatable table-responsive pt-0">
    <table class="siswaf table">
      <thead>
        <tr>
          <th></th>
          <th>Nisn</th>
          <th>Nis</th>
          <th>Nama</th>
          <th>Nomer</th>
          <th>Tahun</th>
          <th>Alamat</th>
          <th>Password</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!-- Modal to add Tambah ssiwa -->
<div class="offcanvas offcanvas-end" id="tambah-siswa">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="exampleModalLabel">Tambah / Edit Siswa</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form class="tambah-siswa pt-0 row g-2" id="form-tambah-siswa" onsubmit="return false">
      @csrf
      <input type="hidden" name="fid" id="fid">
      <div class="col-sm-12">
        <label class="form-label" for="nisn">NISN</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-id"></i></span>
          <input type="number" id="nisn" class="form-control dt-nisn" name="nisn" placeholder="0000xxx"/>
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="nis">NIS</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-id-badge-2"></i></span>
          <input type="number" id="nis" class="form-control dt-nis" name="nis" placeholder="000xxx"/>
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="nama">Nama Lengkap</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-user"></i></span>
          <input type="text" id="nama" class="form-control dt-nama" name="nama" placeholder="John Doe"/>
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="kls">Kelas</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-school"></i></span>
          <select class="form-control dt-kelas" name="kelas" id="kls">
            @foreach ($kelas as $lk)
            <option value="{{ $lk->id_kelas }}">{{ $lk->nama_kelas.' '.$lk->kompetensi_keahlian }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="almt">Alamat</label>
        <div class="input-group input-group-merge">
          <span id="usrn" class="input-group-text"><i class="ti ti-address-book"></i></span>
          <textarea class="form-control dt-alamat" name="alamat" id="almt" rows="2" placeholder="Jl ..."></textarea>
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="nomer">No Telephon</label>
        <div class="input-group input-group-merge">
          <span id="pw2" class="input-group-text"><i class="ti ti-phone"></i></span>
          <input type="number" id="nomer" name="nomer" class="form-control dt-nomer" placeholder="0831xx"/>
        </div>
      </div>
      <div class="col-sm-12 mb-2">
        <label class="form-label" for="sppf">Tahun</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-credit-card"></i></span>
          <select class="form-control dt-spp" name="spp" id="sppf">
            @foreach ($spp as $lp)
            <option value="{{ $lp->id_spp }}">{{ $lp->tahun }}</option>
            @endforeach
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
<script src="/assets/js/admin/siswa.js"></script>
@endsection