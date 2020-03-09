@extends('layouts./header')
@section('content')
    <div class="bread">account > edit</div>
    <div class="container">
        <h4>ユーザー情報の変更</h4>
        <form action="/account_update_done" method="post">
        {{ csrf_field() }}
        <div class="input_wrapper">
                @if($errors->has('email'))
                    <p class="error_message ">e-mailの値が間違っています。</p>
                @endif
                @if(old('name') != null || old('email') != null)
                    <input type="text" name="name" value="{{old('name')}}" class="form_data">
                    <input type="text" name="email" value="{{old('email')}}" class="form_data">
                @else
                    <input type="text" name="name" value="{{$loginInfo['user_name']}}" class="form_data">
                    <input type="text" name="email" value="{{$loginInfo['email']}}" class="form_data">
                @endif
                <input type="submit" value="変更する" class="submit_data">
        </div>
        </form>
    </div>
@endsection

<style>

    .input_wrapper{
        margin-top:80px;
        text-align:center;
    }

    .form_data{
        display:block;
        width:30%;
        margin: 20px auto;
    }

    .submit_data{
        width:80px;
        display:block;
        margin:0 auto;
    }
</style>