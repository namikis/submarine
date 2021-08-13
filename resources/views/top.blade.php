@if(app('env') != 'production')
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
@else
    <link rel="stylesheet" href="{{secure_asset('/css/main.css')}}">
@endif
<div class="top_wrapper">
    <div class="top_content">
        <div class="top_title">
            <h1>Submarine</h1>
        </div>
        <div class="top_start">
            <a href="/home" class="button">let’s start!</a>
        </div>
    </div>
</div>

<style>
    .top_wrapper{
        background-image:url("{{asset('/img/sea.jpg')}}");
        height:100%;
        width:100%;
        text-align:center;
    }

    html,body{
        margin:0;
    }

    .top_title{
        color:white;
        margin-bottom:15px;
    }

    .top_content{
        margin-top: 270px;
        background-color: #F8A900;
        border-radius: 10px;
        display: inline-block;
        padding: 30px 60px;
    }
</style>