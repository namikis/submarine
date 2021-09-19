@if(app('env') != 'production')
    <link rel="stylesheet" href="{{ asset('css/approval.css') }}">
@else
    <link rel="stylesheet" href="{{ secure_asset('css/approval.css') }}">
@endif
@extends('./layouts/header')
@section('content')
    <div class="bread">{{ $bread }}</div>
    <div class="container">
        <div class="mail_form_wrapper">
            <p class="form_message">コンテンツの投稿には<span>管理者の承認</span>が必要となります。</p>
            <p class="form_message">以下のフォームに、承認後の<span>返信用メールアドレス</span>を入力してください（取得したアドレスは手続き完了後に廃棄されます）。</p>
            <form action="/content/approval" method="post">
            {{ csrf_field() }}
                <div class="email_wrapper">
                    <input type="text" name="email" class="email_input"><input type="submit" value="送信">
                </div>
            </form>
        </div>
    </div>
@endsection
