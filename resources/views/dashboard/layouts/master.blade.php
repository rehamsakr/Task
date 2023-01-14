<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="author" content="Reham-Ahmed" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

<div class="wrapper">
    @include('dashboard.layouts.header')

    <div class="container">
        @yield('content')
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
@yield('js')
<!-- My Custom Sctipt File -->
<script>
    const CONFIRMATION_MSG = '{{ __('translation.are_you_sure') }}';
</script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
