<!doctype html>
<html>
<head>
    @include('admin.includes.head')
</head>
<body>
<body class="hold-transition sidebar-mini layout-fixed">

   <div class="wrapper">
        @include('admin.includes.header')
  

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
            @include('admin.includes.sidebar')
       
        <!-- main content -->
       <div class="content-wrapper">
            @yield('content')
        </div>

    </div>

    <footer class="row">
        @include('admin.includes.footer')
    </footer>

</div>
</body>
</html>
