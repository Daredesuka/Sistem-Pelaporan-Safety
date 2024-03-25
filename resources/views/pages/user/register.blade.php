<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Login | Pelaporan Safety</title>

  @stack('prepend-style')
  @include('includes.admin.style')
  @stack('addon-style')
</head>

<body class="bg-default">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="/">
        Pelaporan Safety
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="/">
               Pelaporan Safety
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="/" class="nav-link">
              <span class="nav-link-inner--text">Home</span>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ url('tentang')}}" class="nav-link">
                <span class="nav-link-inner--text">Tentang</span>
            </a>
          </li>
        </ul> --}}
        <hr class="d-lg-none" />

      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Register</h1>
              <p class="text-lead text-white">Silahkan isi form dibawah ini untuk membuat akun baru.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8">
            <div class="card bg-secondary border-0">
              <div class="card-header bg-transparent pb-5">
                <!-- with google -->
                {{-- <div class="text-muted text-center mt-2 mb-4"><small>Sign up with</small></div>
                <div class="text-center">
                  <a href="#" class="btn btn-neutral btn-icon mr-4">
                    <span class="btn-inner--icon"><img src="{{ asset('assets/backend/img/icons/common/facebook.svg')}} "></span>
                    <span class="btn-inner--text">Facebook</span>
                  </a>
                  <a href="#" class="btn btn-neutral btn-icon">
                    <span class="btn-inner--icon"><img src="{{ asset('assets/backend/img/icons/common/google.svg')}}"></span>
                    <span class="btn-inner--text">Google</span>
                  </a>
                </div>
              </div>
              <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                  <small>Or sign up with credentials</small>
                </div> --}}
                <!-- with google -->
                <form action="{{ route('user.register-post') }}" role="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                          </div>
                          <input type="number" value="{{ old('nik') }}" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" placeholder="NIK">
                            @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                      </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="number " value="{{ old('telp') }}" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" placeholder="No Telpon">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <textarea type="text" value="{{ old('alamat') }}" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Alamat"></textarea>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                        <select name="jenis_kelamin" class="custom-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Silahkan Pilih Jenis Kelamin Anda</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="number" value="{{ old('rt') }}" class="form-control @error('rt') is-invalid @enderror" name="rt" id="rt" placeholder="rt001">
                        @error('rt')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="number" value="{{ old('rw') }}" class="form-control @error('rw') is-invalid @enderror" name="rw" id="rw" placeholder="rw002">
                        @error('rw')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="number" value="{{ old('kode_pos') }}" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" max="99999" id="kode_pos" placeholder="kd pos16515">
                        @error('kode_pos')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                        <select name="province_id" class="custom-select @error('province_id') is-invalid @enderror" id="province_id">
                          <option value="">-- Pilih Provinsi --</option>
                          @foreach($provinces as $province)
                          <option value="{{ $province->id }}">{{ $province->name }}</option>
                          @endforeach
                        </select>
                        @error('province_id')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                        <select name="regency_id" class="custom-select @error('regency_id') is-invalid @enderror" id="regency_id">
                          <option value="">-- Pilih Kota/Kabupaten --</option>
                        </select>
                        @error('regency_id')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                        <select name="district_id" class="custom-select @error('district_id') is-invalid @enderror" id="district_id">
                          <option value="">-- Pilih Kecamatan --</option>
                        </select>
                        @error('district_id')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                        <select name="village_id" class="custom-select @error('village_id') is-invalid @enderror" id="village_id">
                          <option value="">-- Pilih Desa/Kelurahan --</option>
                        </select>
                        @error('village_id')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>
                  <!-- <div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div> -->
                  <!-- <div class="row my-4">
                    <div class="col-12">
                      <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                        <label class="custom-control-label" for="customCheckRegister">
                          <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                        </label>
                      </div>
                    </div>
                  </div> -->
                  <div class="text-center">
                    <button type="submit"  class="btn btn-primary mt-4">Buat Akun</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-right">
                  <a href="{{ url('login')}}" class="text-light"><small>Sudah punya akun?</small></a>
                </div>
              </div>
          </div>
        </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">

          <div class="copyright text-center text-muted">
            &copy; Copyright <strong><span><a href="" target="_blank">PT. Younexa Inti Materials</a></span></strong>. Web Safety
          </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  @stack('prepend-script')
  @include('includes.admin.script')
  @stack('addon-script')

  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

  <script>
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });

      $(function() {
        $('#province_id').on('change', function() {
          let province_id = $('#province_id').val();

          console.log(province_id);

          $.ajax({
            type: 'POST',
            url: "{{ route('getkota') }}",
            data: {
            province_id: province_id},
            cache: false,

            success: function(message) {
              $('#regency_id').html(message);
              $('#district_id').html('');
              $('#village_id').html('');
            },
            error: function(data) {
              console.log(`Error on ${data}`);
            }
          });
        });

        $('#regency_id').on('change', function() {
          let regency_id = $('#regency_id').val();
          $.ajax({
            type: 'POST',
            url: "{{ route('getkecamatan') }}",
            data: {regency_id: regency_id},
            cache: false,

            success: function(message) {
              $('#district_id').html(message);
              $('#village_id').html('');
            },

            error: function(data) {
            console.log(`Error on ${data}`);
            }
          });
        });

        $('#district_id').on('change', function() {
          let district_id = $('#district_id').val();
          $.ajax({
            type: 'POST',
            url: "{{ route('getdesa') }}",
            data: {district_id: district_id},
            cache: false,

            success: function(message) {
            $('#village_id').html(message);},
            error: function(data) {
            console.log(`Error on ${data}`);
          }

          })
        })
      })
    });
  </script>

</body>

</html>
