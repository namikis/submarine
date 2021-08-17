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

<style>
    .mail_form_wrapper{
        width:60%;
        margin:0px auto;
        padding:30px 0;
    }
    .email_wrapper{
        margin:20px;
    }

    .form_message{
        font-size:22px;
    }
    .form_message span{
        font-weight:bold;
    }
    .email_input{
        width:50%;
    }
</style>