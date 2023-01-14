<!DOCTYPE html>
<html lang="en">
<head>
    <title>404 Page Not Found</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/404.css') }}">
</head>

<body>
<div class="wrapper">
    <div id="clouds">
        <div class="cloud x1"></div>
        <div class="cloud x1_5"></div>
        <div class="cloud x2"></div>
        <div class="cloud x3"></div>
        <div class="cloud x4"></div>
        <div class="cloud x5"></div>
    </div>

    <div class='c'>
        <div class='_404'>404</div>
        <hr>
        <div class='_1'>THE PAGE</div>
        <div class='_2'>WAS NOT FOUND</div>

        <a class='btn' href='{{ route('dashboard.home') }}'>BACK TO HOME</a>
    </div>
</div>
</body>
</html>
