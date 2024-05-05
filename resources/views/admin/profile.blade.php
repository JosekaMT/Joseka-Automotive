@extends('layouts.admin')

@section('template_title')
Profile
@endsection

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 ps ps--active-x">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-0 shadow-none bg-black" id="navbarBlur">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
        </ol>
        <h6 class="font-weight-normal mb-0 text-white" style="font-size: 1.2rem;">Profile</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <div class="container-fluid py-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{ asset('img/fondo-profile.jpg') }}');">
      <span class="mask bg-gradient-dark opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
      <div class="row gx-4 mb-2">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm" style="width: 100px; height: 70px; object-fit: cover;">
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{ Auth::user()->name }}
            </h5>
            <p class="mb-0 font-weight-normal text-sm">
              {{ Auth::user()->is_admin ? 'Admin' : Auth::user()->role }} / Co-Founder
            </p>
          </div>
        </div>
      </div>


      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <!-- Columna de Información Básica -->
          <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Basic Information</h6>
              </div>
              <div class="card-body p-3">
                <div class="mb-3">
                  <label for="name" class="form-label">Full Name</label>
                  <input type="text" class="form-control border" id="name" name="name" value="{{ auth()->user()->name }}">
                </div>
                <div class="mb-3">
                  <label for="phone_number" class="form-label">Mobile</label>
                  <input type="text" class="form-control border" id="phone_number" name="phone_number" value="{{ auth()->user()->phone_number }}">
                </div>
                <div class="mb-3">
                  <label for="city" class="form-label">City</label>
                  <input type="text" class="form-control border" id="city" name="city" value="{{ auth()->user()->city }}">
                </div>
              </div>
            </div>
          </div>

          <!-- Columna de Información de Contacto -->
          <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Contact Information</h6>
              </div>
              <div class="card-body p-3">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control border" id="email" name="email" value="{{ auth()->user()->email }}">
                </div>
                <div class="mb-3 position-relative">
                  <label for="password" class="form-label">New Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control border" id="password" name="password">
                    <button type="button" class="btn btn-outline-dark" onclick="togglePasswordVisibility('password')">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                </div>
                <div class="mb-3 position-relative">
                  <label for="password_confirmation" class="form-label">Confirm New Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control border" id="password_confirmation" name="password_confirmation">
                    <button type="button" class="btn btn-outline-dark" onclick="togglePasswordVisibility('password_confirmation')">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Columna de Foto de Perfil -->
          <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Profile Photo</h6>
              </div>
              <div class="card-body p-3">
                <div class="mb-3">
                  <label for="profile_photo" class="form-label">Upload New Photo</label>
                  <input type="file" class="form-control border" id="profile_photo" name="profile_photo">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Update All</button>
          </div>
        </div>
      </form>

      <script>
        function togglePasswordVisibility(inputId) {
          const passwordInput = document.getElementById(inputId);
          const buttonIcon = passwordInput.nextElementSibling.querySelector('i');
          if (passwordInput.type === "password") {
            passwordInput.type = "text";
            buttonIcon.classList.remove('bi-eye');
            buttonIcon.classList.add('bi-eye-slash');
          } else {
            passwordInput.type = "password";
            buttonIcon.classList.remove('bi-eye-slash');
            buttonIcon.classList.add('bi-eye');
          }
        }
      </script>



    </div>
  </div>
</main>

@endsection