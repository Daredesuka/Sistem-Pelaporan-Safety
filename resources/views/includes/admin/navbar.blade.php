 <!-- Topnav -->
 <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search form -->
        {{--<form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
          <button type="button" class="close" data-action="search-close" data-target="id" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </form>--}}
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center  ml-md-auto ">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
            <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="image" src="https://ui-avatars.com/api/?background=fff&color=0D8ABC&bold=true&name={{ auth('admin')->user()->name }}" class="rounded-circle mr-1">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ auth('admin')->user()->name }}</span>
                </div>
                </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
             <!--  <a href="/admin/dashboard" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a> -->
                <form action="{{ route('admin.logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item" title="Logout" data-toggle="tooltip">
                    {{-- <i class="fas fa-sign-out-alt" style="color: red;"></i> --}}
                      <i class="ni ni-user-run"></i>
                      <span>Log Out</span>
                  </button>
                </form>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
