<!doctype html>
<html>
    <head>
        @yield('css')
        @include('includes.head')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!--Memuat file includes/header.blade.php-->
            @include('includes.header-admin')

            <!--Memuat konten web-->
            @yield('content')

            <!--Memuat file includes/footer.blade.php-->
            @include('includes.footer')
        </div>
        @include('includes.foot')
        @yield('js')
    </body>
</html>