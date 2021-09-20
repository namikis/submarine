<link rel="preload" href="{{ asset('img/sea_wave.jpg') }}" as="script">
@if(app('env') != 'production')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@else
    <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}">
@endif

@extends('layouts./header')
@section('content')
    <div id="app">
        <home/>
    </div>
@endsection

