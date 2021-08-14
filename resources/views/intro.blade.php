@extends('layouts./header')
@section('content')
    <div class="bread">introduction</div>
    <div class="container">
        <div class="whole_intro_wrapper">
            <h1 class="intro_mess">submarineとは？</h1>
            <p>「欲しいものがあるけど、調べてもよくわからない」 そんな経験はありませんか？</p>
            <p>Submarineは世の中の製品やサービスと「出会う」ためのサービスです。</p>
            <h2 class="intro_mess">～3つのアプローチ～</h2>
            <div class="ap_wrapper">
                <p><span class="ap_title">search：</span>タグ検索したものを表示</p>
                <p><span class="ap_title">favorite：</span>お気に入りに登録したものを表示</p>
                <p><span class="ap_title">various：</span>ランダムな一覧を表示（<a href="/various">まずはこちらをお試しください</a>）</p>
            </div>
            <h2 class="intro_mess">さあ、この広大な情報の海を一緒に潜りましょう！</h2>
        </div>
    </div>
@endsection

<style>
    .whole_intro_wrapper{
        padding:50px 0;
        text-align:center;
    }

    .intro_mess{
        margin:20px 0;
    }

    .ap_title{
        font-weight:bold;
        font-size:20px;
    }

    .ap_wrapper{
        text-align:left;
        width:45%;
        margin:0 auto;
    }
</style>