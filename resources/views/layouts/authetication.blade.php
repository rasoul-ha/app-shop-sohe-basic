<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    @stack('appTitle')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App css -->
    <link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>
    @yield('content')
    <!-- end auth-fluid-->
    <!-- bundle -->
    <script src="/admin/assets/js/vendor.min.js"></script>
    <script src="/admin/assets/js/app.min.js"></script>

</body>


</html>
