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
        <link rel="icon" href="{{ asset('/img/submarine_ic.png') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <script src="{{asset('js/main.js')}}"></script>
    @else
        <link rel="icon" href="{{ secure_asset('/img/submarine_ic.png') }}">
        <link rel="stylesheet" href="{{ secure_asset('css/main.css') }}">
        <script src="{{secure_asset('js/main.js')}}"></script>
    @endif

</head>
<body>
    <div class="header">
        <div class="logo-wrapper">
            <a href="/home" class="logo">Submarine</h1></a>
        </div>
        <div class="menu-wrapper">
            @if(isset($loginInfo))
            <div class="header_menu">
                <p class="loginMessage">ようこそ、<a href="/account">{{$loginInfo['user_name']}}</a>様</p>
            </div>
            @else
            <div class="header_menu">
                <a href="/intro" class="loginMessage">Submarineとは？</a>
            </div>
            @endif
            <div class="header_menu">
                <form action="/search" method="get">
                    <input type="text" placeholder="検索" name="keyword">
                    <span class="search_button"><input type="submit" value="&#xf002;"></span>
                </form>
            </div>
            <div class="header_menu menu_head">
                <p class="menu_title"><i class="fa fa-bars" aria-hidden="true"></i></p>
                <div class="hidden_menu">
                @if(isset($loginInfo)==false)
                    <a href="/signIn" class="header-list">ログイン</a>
                    <a href="/various" class="header-list">various</a>
                    <a href="/signUp" class="header-list">新規登録</a>
                @else
                    <a href="/account" class="header-list">Account</a>
                    <a href="/content/form" class="header-list">Add contents</a>
                    <a href="/favorite" class="header-list">favorite</a>
                    <a href="/intro" class="header-list">introduction</a>
                    <a href="/various" class="header-list">various</a>
                    <a href="/logout" class="header-list">ログアウト</a>
                @endif
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

<script>
    // var header = $('.header');
    // var headerHeight = header.outerHeight(true);

    // $(window).on('scroll',function(){
    //     $scrollTopDistance = $(window).scrollTop();
        
    //     if($scrollTopDistance >= headerHeight){
    //         header.addClass('header_scroll');
    //     }else if($scrollTopDistance <= headerHeight){
    //         header.removeClass('header_scroll');
    //     }
    // });
</script>