<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    @yield('title')

    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @stack('css')
</head>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    @include('components.main.navbar')
    <div>
        <div class="content-overlay"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header">
                @yield('content-header')
            </div>

            <div class="content-body">
                @yield('content-body')
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>

    <div class="drag-target"></div>

    @include('components.main.footer')

    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/js/scripts/pages/modal-add-role.js') }}"></script>
    <script src="{{ asset('vendor/vuexy-html-bootstrap5-admin-template/app-assets/js/scripts/pages/app-access-roles.js') }}"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    @stack('script')
</body>

</html>
