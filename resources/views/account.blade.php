@include('parts.modal')

@extends('layouts./header')


@section('content')

    <div class="bread">{{ $bread }}</div>
    <div class="container">
        <div class="whole_account_wrapper">
            <h4>ユーザー情報</h4>
                <div class="account_wrapper">
                    <table>
                        <tr><th>name:</th><td>{{$loginInfo['user_name']}}</td></tr>
                        <tr><th>e-mail:</th><td>{{$loginInfo['email']}}</td></tr>
                    </table>
                    <div class="edit">
                        <a href="/account_update">変更</a>
                        <a href="#" class="account_delete_button">削除</a>
                    </div>
                </div>
        </div>
    </div>
    <div class="my_contents_wrapper">
        <p>投稿一覧</p>
        <div id="app">
            <list
                login_info = "{{ json_encode($loginInfo) }}"
                Bread = "{{ json_encode($bread) }}"
                Keywords = "{{ json_encode('') }}"
            />
        </div>
    </div>
@endsection

<style>
    .my_contents_wrapper p{
        margin-top:50px;
        font-size:26px;
        text-align:center;
    }
    table{
        margin:0 auto;
    }

    table tr th{
        font-size:25px;
    }
    table tr td{
        font-size:20px;
    }

    .edit{
        text-align:center;
        margin-top:50px;
    }

    .edit a{
        background-color:black;
        color:white;
        padding:5px;
        margin:0 10px;
    }

    .account_wrapper{
        margin-top:50px;
    }

    .whole_account_wrapper{
        padding:45px;
    }
</style>