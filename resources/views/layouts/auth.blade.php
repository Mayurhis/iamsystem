<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>
  
    <link href="{{ asset('backend/images/fav-icon.png') }}" rel="icon">
  
    <!-- font-awesome Start  -->
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
    <!-- End font-awesome Start  -->
  
    <!-- Bootstrap css -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" async>
  
    <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}" async>

</head>
<body class="admin-dashboard">
  
    @yield('main-content')

    <!-- Jquery Library -->
    <script src="{{ asset('backend/js/assets/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap Js -->
    <script src="{{ asset('backend/js/assets/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/custom.js') }}"></script>

    @include('partials.alert')

    @yield('customJS')

  </body>
</html>
