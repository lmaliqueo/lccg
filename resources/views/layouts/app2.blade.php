<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic/semantic.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo_style.css')}}">


<style type="text/css">

    body {
      background-color: #2A3F54;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }

</style>


    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.0.min.js')}}"></script>
    <script src="{{ asset('js/jquery-ui.js')}}"></script>
    <script src="{{ asset('plugins/semantic/semantic.js')}}"></script>
    <script src="{{ asset('js/nprogress.js')}}"></script>
    <script src="{{ asset('js/sweetalert.min.js')}}"></script>
    <script src="{{ asset('js/jquery.stickytableheaders.js')}}"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

        @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>



