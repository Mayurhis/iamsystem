<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ config('app.name') }}</title>
  
    <link href="{{ asset('backend/images/fav-icon.png') }}" rel="icon">
  
    <!-- font-awesome Start  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <!-- End font-awesome Start  -->
  
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" async>
  
    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  
    <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}" async>

</head>
<body class="admin-dashboard">
  
    @yield('main-content')
  

    <!-- Jquery Library -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Data table  -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- Custom Js -->
    <script src="{{ asset('backend/js/custom.js') }}"></script>

    @include('partials.alert')

    @yield('customJS')

  </body>
</html>
