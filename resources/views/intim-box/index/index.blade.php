@extends('intim-box.layouts.main')
@section('title', $meta['title'])
@section('des', $meta['des'])

@if(isset($path) and $path)
    @section('can', $path)
@endif

@if(isset($webmaster) and $webmaster)
    @section('webmaster', $webmaster['tag'])
@endif
@section('content')
    <div class="catalog__body">

        <div class="catalog-descr">
            <h1 class="catalog-descr__title">
                {{ $meta['h1'] }}
            </h1>
            <p class="catalog-descr__text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.
            </p>
        </div>
        <div class="catalog-items">
            @foreach($posts as $post)
                @include('intim-box.include.item')
            @endforeach

        </div>
    </div>
@endsection

@section('main-menu')
    @include('intim-box.include.main-menu', compact('data'))
@endsection

@section('location')
    @include('intim-box.include.location', compact('data'))
@endsection

@section('open-graph')
    @include('intim-box.include.open-graph', ['title' => $meta['title'], 'des' => $meta['des'], 'image' => '/img/logo.svg'])
@endsection