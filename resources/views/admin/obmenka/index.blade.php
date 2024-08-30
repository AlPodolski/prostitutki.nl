@extends('layouts.app')

@section('title', 'Оплата')

@section('content')

    @include('admin.include.nav')

    @if(isset($monthCount))
        <p>За месяц {{ $monthCount }}</p>
    @endif

    @if(isset($weekPay))
        @if($weekPay)
            @foreach($weekPay as $key => $value)
                {{ $key }} - {{ $value }}<br>
            @endforeach
        @endif
    @endif

    @gridView($gridData)

@endsection
