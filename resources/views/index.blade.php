@extends('base.base')

@section('title', '登录或注册')

@section('css')
    <link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="warning-info">
            <ul>
                <li>错误提示：</li>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="wrapper">
        <div style="padding:20px">
            Loading <span id="dots">...</span>
            <script>
                var dot = document.getElementById("dots");

                function loading() {
                    setTimeout(function() {
                        dot.textContent = dot.textContent + ".";
                        loading();
                    }, 200);
                }
                loading();
            </script>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="/js/build/index_react.js"></script>
@endsection