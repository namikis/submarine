@extends('layouts./header')
@section('content')
    <div class="home_contaniner">
        <h1 class="home-head"><span>What</span> do you want?</h1>
        <form action="/search" method="get">
            <input type="text" class="homeSearch" placeholder="Service, Product" name="keyword">
            <button type="submit" class="homeSearchSubmit button">search</button>
        </form>
</div>
@endsection

<style>
    .home-head{
        text-align:center;
        margin-top:200px;
        margin-bottom:60px;
        font-size:45px;
    }

    .home-head span{
        color:#F8A900;
    }

    .homeSearch{
        width:60%;
        display:block;
        margin:0 auto;
        text-align:center;
        font-size:20px;
    }

    .homeSearchSubmit{
        width:10%;
        height: 40px;
        margin: 0 auto;
        display: block;
        margin-top:50px;
}

    .home_container{
        max-width:1140px;
        margin:150px auto 100px auto;
    }
</style>