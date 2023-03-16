@extends(Auth::user() ? '_layouts.app-siswa' : '_layouts.app');

@section('title', 'Profil Siswa')

@section('cssv')
<link rel="stylesheet" href="/assets/vendor/css/pages/page-profile.css" />
@endsection

@section('content')           
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Siswa /</span> Profil
</h4>

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="user-profile-header-banner">
        <img src="/assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top">
      </div>
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img src="{{ $dat->avatar }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
            <div class="user-profile-info">
              <h4>{{ $dat->nama }}</h4>
              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <li class="list-inline-item"><i class='ti ti-calendar'></i> Bergabung {{ $dat->created_at }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- User Profile Content -->
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-body">
        <small class="card-text text-uppercase">Tentang</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-id"></i><span class="fw-bold mx-2">NISN:</span> <span>{{ $dat->nisn }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="ti ti-id-badge-2"></i><span class="fw-bold mx-2">NIS:</span> <span>{{ $dat->nis }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="ti ti-user"></i><span class="fw-bold mx-2">Nama Lengkap:</span> <span>{{ $dat->nama }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="ti ti-home-2"></i><span class="fw-bold mx-2">Alamat:</span> <span>{{ $dat->alamat }}</span></li>
        </ul>
        <small class="card-text text-uppercase">Kontak</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Telepon:</span> <span>{{ $dat->no_telp }}</span></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-body">
        <p class="card-text text-uppercase">Sekolah</p>
        <ul class="list-unstyled mb-0">
          <li class="d-flex align-items-center mb-3"><i class="ti ti-crown"></i><span class="fw-bold mx-2">Kelas:</span> <span>{{ $dat->nama_kelas }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="ti ti-school"></i><span class="fw-bold mx-2">Jurusan:</span> <span>{{ $dat->kompetensi_keahlian }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="ti ti-check"></i><span class="fw-bold mx-2">Angkatan:</span> <span>{{ $dat->tahun }}</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection