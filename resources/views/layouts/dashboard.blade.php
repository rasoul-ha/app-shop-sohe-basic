<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    @stack('appTitle')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App css -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    @stack('css')
</head>

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid">
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            <!-- LOGO -->
            <a href="{{ route('dashboard') }}" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="/admin/assets/images/logo.png" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="/admin/assets/images/logo_sm.png" alt="" height="16">
                </span>
            </a>


            <div class="h-100" id="leftside-menu-container" data-simplebar>

                <!--- Sidemenu -->
                <ul class="side-nav">


                    <x-dashboard.sidebar />
                </ul>

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <x-dashboard.topbar />
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid" id="app">
                    @yield('content')
                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            <x-dashboard.footer />
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->


    <div class="rightbar-overlay"></div>
    <!-- /End-bar -->

    <!-- bundle -->
    <script src="/js/app.js"></script>
    <script src="/admin/assets/js/vendor.min.js"></script>
    <script src="/admin/assets/js/app.min.js"></script>
    <script src="/js/sweetalert.js"></script>

    @stack('js')

    <!-- end demo js-->
</body>

</html>
