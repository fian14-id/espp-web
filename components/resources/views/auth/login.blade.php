@extends('_layouts.auth')

@section('title', 'Login')

@section('content')
<!-- /Left Text -->
<div class="d-none d-lg-flex col-lg-7 p-0">
  <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
    <img
      src="/assets/img/illustrations/auth-login-illustration-light.png"
      alt="auth-login-cover"
      class="img-fluid my-5 auth-illustration"
      data-app-light-img="illustrations/auth-login-illustration-light.png"
      data-app-dark-img="illustrations/auth-login-illustration-dark.png"
    />

    <img
      src="/assets/img/illustrations/bg-shape-image-light.png"
      alt="auth-login-cover"
      class="platform-bg"
      data-app-light-img="illustrations/bg-shape-image-light.png"
      data-app-dark-img="illustrations/bg-shape-image-dark.png"
    />
  </div>
</div>
<!-- /Left Text -->

<!-- Login -->
<div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
  <div class="w-px-400 mx-auto">
    <!-- Logo -->
    <div class="app-brand mb-4">
      <a href="/" class="app-brand-link gap-2">
        <span class="app-brand-logo demo">
          <img src="/assets/img/logo.png" alt="{{ env('APP_NAME') }}" width="30">
        </span>
      </a>
    </div>

    <!-- /Logo -->
    <h3 class="mb-1 fw-bold">Selamat datang di E-SPP! 👋</h3>
    <p class="mb-4">Silakan masuk ke akun Anda dan mulai petualangan</p>

      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#log-siswa" aria-controls="log-siswa" aria-selected="true">Siswa</button></li>
        <li class="nav-item"><button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#log-petugas" aria-controls="log-petugas" aria-selected="false">Petugas</button></li>
      </ul>
      <div class="tab-content mt-2">
        <div class="tab-pane fade show active" id="log-siswa" role="tabpanel">
          <form id="formAuthenticationSiswa" class="mb-3" method="POST">
            @csrf
            <input type="hidden" name="type" value="siswa">
            <div class="mb-3">
              <label for="nisn" class="form-label"> NISN</label>
              <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan NISN Anda" autofocus />
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Kata Sandi</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">Masuk</button>
          </form>
        </div>
        <div class="tab-pane fade" id="log-petugas" role="tabpanel">
          <form id="formAuthenticationPetugas" class="mb-3" method="POST">
            @csrf
            <input type="hidden" name="type" value="petugas">
            <div class="mb-3">
              <label for="usrnm" class="form-label"> Nama Pengguna</label>
              <input type="text" class="form-control" id="usrnm" name="username" placeholder="Masukkan nama pengguna Anda" autofocus />
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Kata Sandi</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">Masuk</button>
          </form>
        </div>
      </div>
      
  </div>
</div>
<!-- /Login -->
@endsection

@section('js')
<script src="/assets/js/auth/login.js"></script>
@endsection