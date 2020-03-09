@extends('layouts./header')

@section('content')
    <div class="bread">ログイン</div>
    <div class="container">
        <div class="login_wrapper">
            <!-- @if(count($errors) > 0)
             <div>
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
             </div>
            @endif -->
            <form action="/login" method="post">
            {{ csrf_field() }}

                @if(isset($message))
                    <p class="error_message">{{$message}}</p>
                @endif
                
                <div class="input_form">
                    @if($errors->has('email'))
                        <p class="error_message">メールアドレスが間違っています</p>
                    @endif
                    <input type="email" name="email" placeholder="メールアドレス" value="{{old('email')}}">
                </div>
                
                <div class="input_form">
                    @if($errors->has('pass'))
                        <p class="error_message">パスワードが間違っています</p>
                    @endif
                    <input type="password" name="pass" placeholder="パスワード" value="{{old('pass')}}">
                </div>
                <p><input type="submit" value="ログイン"></p>

                <a href="/signUp">新規登録はこちら</a>
            </form>
        </div>


    </div>
@endsection

<style>
    .login_wrapper{
        text-align:center;
        padding:50px 0;
    }
   
   
</style>
