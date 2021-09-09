@extends('layouts/header')
@section('content')
    <div class="bread">
        {{ $bread }}
    </div>
    <div class="container">
        <p>{{ $done_message }}</p>
        <p><a href="/home">トップページへ</a></p>
    </div>
@endsection