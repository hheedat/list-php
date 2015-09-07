@extends('base.base')

@section('title', 'list')

@section('css')
    <link rel="stylesheet" href="/css/list.css">
@endsection

@section('content')
    <div class="wrapper">

        {{--<div>--}}
        {{--@foreach ($listItem as $item)--}}
        {{--<p>This is list item {{ $item->id }} title {{$item->title}}</p>--}}
        {{--@endforeach--}}
        {{--</div>--}}

        <div id="list-con" class="list-con">
            Loading <span id="dots">...</span>
            <script>
                var dot = document.getElementById("dots");

                function loading() {
                    setTimeout(function () {
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
    <script src="http://s2.qhimg.com/!05cf2e19/moment.js"></script>
    <script src="/js/build/list_react.js"></script>
@endsection