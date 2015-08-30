<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="/css/reset.css">
    @yield('css')
</head>
<body>
    @include('base.head')

    @yield('content')

    @yield('javascript')
</body>
</html>