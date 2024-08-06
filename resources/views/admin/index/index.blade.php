@extends('layouts.app')

@section('title', 'Администратор')

@section('content')
    @include('admin.include.nav')

    <div class="col-12">
        <p>Блокировки доменов</p>
        @if($blockDomains)
            @foreach($blockDomains as $item)
                {{ $item->domain }} - {{ $item->created_at }}<br>
            @endforeach
        @endif
    </div>
    <div class="col-12">
        <p>Блокировки городов</p>
        @if($cityBlock)
            @foreach($cityBlock as $item)
                {{ $item->old_city }} - {{ $item->new_city }} - {{ $item->created_at }}<br>
            @endforeach
        @endif
    </div>

@endsection
