@extends('layouts./header')

@section('content')
    <div class="bread">{{$bread}}</div>
    <div class="container">
        <div class="detail_wrapper">
            <div class="detail_image">
             <img src="{{asset('/img/test/'.$contents->image_name)}}">
            </div>

            <div class="content_favorite_wrapper">
            @if($contents->favo == null)
                <a href="/update_favo?content_id={{$contents->id}}" class="content_favorite button">fav</a>
            @else
                <a href="/update_favo?content_id={{$contents->id}}" class="content_favorite faved">faved</a>
            @endif
            </div>
        
            <div class="detail_pr">
            <p class="detail_title"><span>what is this?</span></p>
                @if($contents->content_detail != null)
                    <p class="detail_text">{{$contents->content_detail}}</p>
                @else
                    <p class="detail_text">記載なし</p>
                @endif
            </div>

            <div class="detail_link">
            <p class="detail_title"><span>the link</span></p>
                @if($contents->content_link)
                    <a href="{{$contents->content_link}}">{{$contents->content_link}}</a>
                @else
                    <p>記載なし</p>
                @endif
            </div>
        </div>
    </div>
    
@endsection

<style>
    .detail_wrapper{
        text-align:center;
        padding:25px 0;
    }

    .detail_image{
        margin: 20px auto;
        width: 60%;
        border: 1px solid #3c3c3c;
    }

    .detail_image img{
        max-height:400px;
        max-width:60%;
    }

    .detail_pr,.detail_link{
        margin: 40px auto;
        border: 1px solid #3c3c3c;
        width: 60%;
        position:relative;
        padding: 30px 0px 20px 0px;
    }
    
    .detail_pr{
        text-align: left;
    }

    .detail_title{
        font-size: 25px;
        text-align: left;
        position:absolute;
        top:-40;
        left:-10;
    }

    .detail_title span{
        background-color:#F8A900;
        color:white;
        padding:3px 10px;
        border-radius:20px;
    }

    .detail_text{
        padding:0 20px;
        font-size:18px;
        word-break:break-all;
        line-height:35px;
    }
    
    .content_favorite_wrapper{
        text-align:right;
        margin:0px auto;
        width:60%;
    }

    .faved{
        opacity:0.9;
        color:lightgrey;
        padding: 5px 20px;
        width: 15%;
        background: linear-gradient(to top, #0000d2, #5bcaff);
        border-radius: 20px;
        font-size: 18px;
        cursor: pointer;
    }

</style>

<script src="{{asset('js/fav.js')}}"></script>