<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="/css/reset.css">
    @yield('css')
</head>
<body>
    @include('base.head')

    @yield('content')


    <script src="http://s4.qhimg.com/!3a2f956f/jquery-2.1.4.min.js"></script>
    <script src="http://s1.qhimg.com/!64f42f7b/react.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('javascript')
</body>
</html>