<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>@yield('title') | Pelaporan Safety</title>

  @stack('prepend-style')
  @include('includes.admin.style')
  @stack('addon-style')

</head>

<body>
  <!-- Sidenav -->
  @include('includes.admin.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    @include('includes.admin.navbar')

    @yield('content')

    @include('includes.admin.footer')
  </div>
  @stack('prepend-script')
  @include('includes.admin.script')
  @stack('addon-script')
  @include('sweetalert::alert')
</body>

</html>
