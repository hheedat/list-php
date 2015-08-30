@extends('base.base')

@section('title', 'login and register')

@section('css')
    <link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
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
    <script src="/js/build/common.js"></script>
    <script src="/js/build/index_react.js"></script>
@endsection