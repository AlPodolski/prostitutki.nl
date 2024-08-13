@extends('layouts.app')

@section('title', 'Оплата')

@section('content')

    @include('admin.include.nav')

    <p>За месяц {{ $monthCount }}</p>

    @if($weekPay)
        @foreach($weekPay as $key => $value)
            {{ $key }} - {{ $value }}<br>
        @endforeach
    @endif

    @gridView($gridData)

@endsection
