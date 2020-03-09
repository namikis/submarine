@extends('layouts./header')
@section('content')
    <div class="bread">新規登録</div>
    <div class="container">
        <div class="new_wrapper">
            <form action="/register" method="post">
                    {{ csrf_field() }}

                        <div class="input_form">
                            @if($errors->has('name'))
                                <p class="error_message">名前は必須です。</p>
                            @endif

                            <input type="text" name="name" placeholder="お名前"  value="{{old('name')}}">
                        </div>
                        
                        <div class="input_form">
                            @if($errors->has('email'))
                                <p class="error_message">メールアドレスの値が不正または重複しています。</p>
                            @endif
                            <input type="email" name="email" placeholder="メールアドレス" value="{{old('email')}}">
                        </div>

                        
                        <div class="input_form">
                            @if($errors->has('pass'))
                                <p class="error_message">パスワードは４文字以上にしてください。</p>
                                <p class="error_message">{{$errors->first('password')}}</p>

                            @endif
                            <input type="password" name="pass" placeholder="パスワード" value="{{old('pass')}}">
                        </div>
                        
                        <p><input type="submit" value="登録"></p>
                    </form>
        </div>
    </div>
@endsection

<style>
    .new_wrapper{
        text-align:center;
        padding:50px 0;
    }
</style>
