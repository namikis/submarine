<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Submarine</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
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
                <a href="/signUp" class="loginMessage">新規登録</a>
            </div>
            @endif
            <div class="header_menu">
                <form action="/search" method="get">
                    <input type="text" placeholder="検索" name="keyword">
                    <span class="search_button"><input type="submit" value="go"></span>
                </form>
            </div>
            <div class="header_menu">
                <p class="menu_title">Menu</p>
                <div class="hidden_menu">
                @if(isset($loginInfo)==false)
                    <a href="/signIn" class="header-list">ログイン</a>
                    <a href="/intro" class="header-list">introduction</a>
                    <a href="/various" class="header-list">various</a>
                @else
                    <a href="/account" class="header-list">Account</a>
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

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>


<style>
    .header{
        background: linear-gradient(to top, #0000d2, #5bcaff);
        padding:0px 30px;
        display:flex;
        align-items:center;
        position:fixed;
        top:0;
        left:0;
        right:0;
        z-index:97;
    }

    .header_menu{
        display:inline-block;
        position:relative;
        margin:0 30px;
    }

    .header_menu p a{
        color:#F8A900;
    }

    .logo-wrapper{
        margin-right:auto;
    }

    .logo{
        display:inline-block;
        margin-right:50%;
        color:#F8A900;
        font-weight:bold;
        font-size:35px;
    }

    .header-list{
        background-color:white;
        padding:5px;
        display:block;
        border:1px solid black;
        color:blue;
    }

    .hidden_menu{
        position:absolute;
        top:70px;
        right: -55%;
        width: 150px;
        text-align: center;
        display:none;
    }

    .search_button{
        margin:-10px;
    }

    .menu_title{
        font-size:20px;
        background-color:white;
        color:black;
        padding:5px 10px;
        border-radius:20px;
        cursor:pointer;
    }

    .loginMessage{
        color:white;
    }

    .header_scroll{
        height:50px;
    }
</style>

<script>
    var header = $('.header');
    var headerHeight = header.outerHeight(true);

    $(window).on('scroll',function(){
        $scrollTopDistance = $(window).scrollTop();
        
        if($scrollTopDistance >= headerHeight){
            header.addClass('header_scroll');
        }else if($scrollTopDistance <= headerHeight){
            header.removeClass('header_scroll');
        }
    });
</script>