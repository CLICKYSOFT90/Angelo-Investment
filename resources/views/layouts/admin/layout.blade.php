<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">

    @yield('title')

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/flatpickr/flatpickr.css')}}" />
{{--    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/apex-charts/apex-charts.css')}}" />--}}

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('admin/assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{asset('admin/assets/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('admin/assets/js/config.js')}}"></script>
    @yield('styles')
</head>
<body class="font-sans antialiased">
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('includes.admin.aside')
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('includes.admin.nav')
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                </div>
                @include('includes.admin.footer')
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset('admin/assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('admin/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('admin/assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src="{{asset('admin/assets/vendor/libs/hammer/hammer.js')}}"></script>

<script src="{{asset('admin/assets/vendor/libs/i18n/i18n.js')}}"></script>
<script src="{{asset('admin/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

<script src="{{asset('admin/assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
{{--<script src="{{asset('admin/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>--}}
<script src="{{asset('admin/assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('admin/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('admin/assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="{{asset('admin/assets/js/dashboards-analytics.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('js/additional-methods.js')}}"></script>
<script>
    (function () {
        var dateToday = new Date();
        // Init custom option check
        window.Helpers.initCustomOptionCheck();

        // Bootstrap validation example
        //------------------------------------------------------------------------------------------
        // const flatPickrEL = $('.flatpickr-validation');
        const flatPickrList = [].slice.call(document.querySelectorAll('.flatpickr-validation'));
        // Flat pickr
        if (flatPickrList) {
            flatPickrList.forEach(flatPickr => {
                flatPickr.flatpickr({
                    dateFormat: 'd-m-Y',
                    allowInput: true,
                    monthSelectorType: 'dropdown',
                    minDate: dateToday,
                });
            });
        }
    })();
</script>

@if (session('success'))
    <script type="text/javascript">
        {{--Swal.fire(--}}
        {{--    'Success',--}}
        {{--    '{!! session('success') !!}',--}}
        {{--    'success'--}}
        {{--)--}}
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{!! session('success') !!}'
        })
    </script>
@endif
@if (session('alert'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: "{!! session('alert') !!}",
        })
    </script>
@endif
@yield('scripts')
</body>
</html>
