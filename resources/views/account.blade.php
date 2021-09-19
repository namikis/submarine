@if(app('env') != 'production')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@else
    <link rel="stylesheet" href="{{ secure_asset('css/account.css') }}">
@endif
@extends('layouts./header')
@section('content')

    <div class="bread">{{ $bread }}</div>
    <div id="app">
        <div class="container">
            <div class="whole_account_wrapper">
                <h4 class="user_info">ユーザー情報</h4>
                    <div class="account_wrapper">
                        <table>
                            <tr><th>name:</th><td>{{$loginInfo['user_name']}}</td></tr>
                            <tr><th>e-mail:</th><td>{{$loginInfo['email']}}</td></tr>
                        </table>
                        <div class="edit">
                            <div><a href="/account_update" class="account_button">変更</a></div>
                            <modal
                                modal_mode = "{{ json_encode('account_del') }}"
                            />
                        </div>
                    </div>
            </div>
        </div>
        <div class="my_contents_wrapper">
            <p>投稿一覧</p>
            <div>
                <list
                    login_info = "{{ json_encode($loginInfo) }}"
                    Bread = "{{ json_encode($bread) }}"
                    Keywords = "{{ json_encode('') }}"
                />
            </div>
        </div>
    </div>
@endsection
