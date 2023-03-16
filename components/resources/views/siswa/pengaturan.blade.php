@extends('_layouts.app-siswa')

@section('title', 'Pengaturan')

@section('cssv')
<link rel="stylesheet" href="/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
<link rel="stylesheet" href="/assets/vendor/libs/animate-css/animate.css" />
<link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Siswa /</span> Pengaturan</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Profil Detail</h5>
      <form id="formAccountSettings" method="POST" onsubmit="return false">
        @csrf
        <input type="hidden" name="type" value="profil" />
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="{{ auth()->user()->avatar }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
            <div class="button-wrapper">
              <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                <span class="d-none d-sm-block">Unggah foto baru</span>
                <i class="ti ti-upload d-block d-sm-none"></i>
                <input type="file" id="upload" name="avatar" class="account-file-input" hidden accept="image/png, image/jpeg" />
              </label>
              <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
              </button>

              <div class="text-muted">Diizinkan JPG, GIF, atau PNG. Ukuran maksimal 800K</div>
            </div>
          </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="nisn" class="form-label">NISN</label>
              <input class="form-control" type="text" id="nisn" name="nisn" value="{{ auth()->user()->nisn }}" readonly />
            </div>
            <div class="mb-3 col-md-6">
              <label for="nama" class="form-label">Nama</label>
              <input class="form-control" type="text" id="nama" name="nama" value="{{ auth()->user()->nama }}" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="nomr" class="form-label">Nomer Telepon</label>
              <input class="form-control" type="text" name="nomer" id="nomr" value="{{ auth()->user()->no_telp }}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="almt" class="form-label">Alamat</label>
              <textarea class="form-control" name="alamat" id="almt" rows="2">{{ auth()->user()->alamat }}</textarea>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
          </div>
        </div>
      </form>
    </div>

    <div class="card mb-4">
      <h5 class="card-header">Ganti kata sandi</h5>
      <div class="card-body">
        <form id="formPWC" method="POST" onsubmit="return false">
          <div class="row">
            @csrf
            <input type="hidden" name="type" value="pw" />
            <div class="mb-3 col-md-6 form-password-toggle">
              <label class="form-label" for="currentPassword">kata sandi saat ini</label>
              <div class="input-group input-group-merge">
                <input class="form-control" type="password" name="currentPassword" id="currentPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="mb-3 col-md-6 form-password-toggle">
              <label class="form-label" for="newPassword">kata sandi baru</label>
              <div class="input-group input-group-merge">
                <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>

            <div class="mb-3 col-md-6 form-password-toggle">
              <label class="form-label" for="confirmPassword">Konfirmasi password baru</label>
              <div class="input-group input-group-merge">
                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
            <div class="col-12 mb-4">
              <h6>Persyaratan Kata Sandi:</h6>
              <ul class="ps-3 mb-0">
                <li class="mb-1">Panjang minimal 8 karakter - semakin banyak, semakin baik</li>
                <li class="mb-1">Setidaknya satu karakter huruf kecil</li>
                <li>Setidaknya satu angka, simbol, atau karakter spasi</li>
              </ul>
            </div>
            <div>
              <button type="submit" class="btn btn-primary me-2">Simpan</button>
              {{-- <button type="reset" class="btn btn-label-secondary">Cancel</button> --}}
            </div>
          </div>
        </form>
      </div>
    </div>

    {{--<div class="card">
      <h5 class="card-header">Hapus akun</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h5 class="alert-heading mb-1">Apakah Anda yakin ingin menghapus akun Anda?</h5>
            <p class="mb-0">Setelah Anda menghapus akun Anda, tidak ada jalan untuk kembali. Harap yakin.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">Saya mengkonfirmasi penonaktifan akun saya</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account">Nonaktifkan Akun</button>
        </form>
      </div>
    </div>--}}
  </div>
</div>
@endsection

@section('jsv')
<script src="/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
<script src="/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
<script src="/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
<script src="/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
@endsection

@section('js')
<script src="/assets/js/pengaturan.js"></script>
@endsection