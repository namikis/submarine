@extends('layouts./header')

@section('content')
    <div class="bread">{{$bread}}</div>
    <div class="container">
        <div id="app">
            <list
                login_info = "{{ json_encode($loginInfo) }}"
                Bread = "{{ json_encode($bread) }}"
                Keywords = "{{ json_encode($keywords) }}"
            />
        </div>
    </div>
@endsection