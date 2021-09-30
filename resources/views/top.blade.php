<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Submarine</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @if(app('env') != 'production')
        <link rel="stylesheet" href="{{asset('/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('/css/top.css')}}">
    @else
        <link rel="stylesheet" href="{{secure_asset('/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('/css/top.css')}}">
    @endif

</head>

<body>
<div class="top_wrapper">
    <div class="top_content">
        <div class="top_title">
            <h1>Submarine</h1>
        </div>
        <div class="top_start">
            <a href="/home" class="button">into the sea!</a>
        </div>
    </div>
</div>
<div>
        <div class="whole_intro_wrapper">
            <h1 class="intro_mess">submarineとは？</h1>
            <p>「欲しいものがあるけど、調べてもよくわからない」 そんな経験はありませんか？</p>
            <p>Submarineは世の中の製品やサービスと「出会う」ためのサービスです。</p>
            <h2 class="intro_mess">一次情報と二次情報</h2>
            <div class="intro_1">
                @if(app('env') != 'production')
                    <img src="{{asset('img/intro1.png')}}" alt="">
                @else
                    <img src="{{secure_asset('img/intro1.png')}}" alt="">
                @endif
            </div>
            
            <h2 class="intro_mess">～3つのアプローチ～</h2>
            <div class="ap_wrapper">
                <div class="ap_list">
                    <p><span class="ap_title">search：</span>タグ検索したものを表示</p>
                    <p><span class="ap_title">favorite：</span>お気に入りに登録したものを表示</p>
                    <p><span class="ap_title">various：</span>ランダムな一覧を表示（<a href="/various">まずはこちらをお試しください</a>）</p>
                </div>
            </div>
            <h2 class="intro_mess">使い方（調べたいものがある場合）</h2>
            <div class="intro_2">
                @if(app('env') != 'production')
                    <img src="{{asset('img/intro2.png')}}" alt="">
                @else
                    <img src="{{secure_asset('img/intro2.png')}}" alt="">
                @endif
            </div>
            <h2 class="intro_mess"><a href="/home">さあ、この広大な情報の海を潜りましょう！</a></h2>
        </div>
</div>
</body>
