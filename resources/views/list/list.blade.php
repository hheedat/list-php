@extends('base.base')

@section('title', 'list')

@section('css')
    <link rel="stylesheet" href="/css/index.css">
@endsection

@section('content')
    <div id="wrapper">
        list page

        <div>
            @foreach ($listItem as $item)
                <p>This is list item {{ $item->id }} title {{$item->title}}</p>
            @endforeach
        </div>

    </div>
@endsection

@section('javascript')
    {{--<script src="/js/build/common.js"></script>--}}
    {{--<script src="/js/build/index_react.js"></script>--}}
@endsection