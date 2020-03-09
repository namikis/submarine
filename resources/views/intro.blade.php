@extends('layouts./header')
@section('content')
    <div class="bread">introduction</div>
    <div class="container">
        <div class="whole_intro_wrapper">
            <h1>submarineとは？</h1>
            <p>「欲しいものがあるけど、調べてもよくわからない」 そんな経験はありませんか？</p>
            <p>Submarineは世の中の製品やサービスを「知る」ためのサービスです。</p>
            <p>3つのアプローチ</p>
            <p>search：検索したものを表示</p>
            <p>favorite：お気に入りに登録したものを表示</p>
            <p>various：ランダムな一覧を表示</p>
            <p>さあ、この広大な情報の海を一緒に潜りましょう！</p>
        </div>
    </div>
@endsection

<style>
    .whole_intro_wrapper{
        text-align:center;
        padding:50px 0;
    }
</style>