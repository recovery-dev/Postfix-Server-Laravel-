<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Email Parsing System </title>

        <!-- Bootstrap -->
        <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ asset("favicon.png") }}">
        <!-- Font Awesome -->
        <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">
        <link href="{{ asset("css/daterangepicker.css") }}" rel="stylesheet">
        <link href="{{ asset("css/custom.css") }}" rel="stylesheet">

        @stack('stylesheets')

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                @include('includes/sidebar')

                @include('includes/topbar')

                @yield('main_container')

                @include('includes/footer')

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset("js/lib/jquery.min.js") }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset("js/lib/bootstrap.min.js") }}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset("js/lib/gentelella.min.js") }}"></script>
        <script src="{{ asset("js/lib/moment/moment.min.js") }}"></script>
        <script src="{{ asset("js/lib/datepicker/daterangepicker.js") }}"></script>
        <script src="{{ asset("js/lib/datepicker/datepicker.js") }}"></script>
        <!-- Functions -->
        <script src="{{ asset("js/imap/imap.js") }}"></script>
        <script src="{{ asset("js/task/task.js") }}"></script>
        <script src="{{ asset("js/emailContents/emailContent.js") }}"></script>

        @stack('scripts')

    </body>
</html>