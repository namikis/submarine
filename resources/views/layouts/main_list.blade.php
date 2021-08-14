@extends('layouts./header')

@section('content')
    <div class="sea_wrapper">
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
    </div>
@endsection
<style>
    .sea_wrapper{
        height:100%;
    }   
</style>