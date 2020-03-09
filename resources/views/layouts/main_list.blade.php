@extends('layouts./header')

@section('content')
    <div class="bread">{{$bread}}</div>
    <div class="container">
    @if(isset($various_flag))
        <div class="reload" onClick="reload()">
            <h2>reload</h2>
        </div>
    @elseif(isset($search_flag))
        <div class="search_result">
            <p>【{{$keywords}}】</p>
        </div>
    @endif

        <div class="contents_wrapper">
        @if(count($contents)>=1)
            @foreach($contents as $content)
                <div class="content">
                    <div class="content_image">
                        <a href="/content_detail?id={{$content->id}}"><img src="{{asset('/img/test/'.$content->image_name)}}"></a>
                    </div>
                    @if($content->tag != null)
                        <span class="content_tag">{{$content->tag}}</span>
                    @endif
                </div>
            @endforeach
        @else  
            <p>一致するものがありません。</p>
        @endif
        </div>
    </div>
@endsection

<style>

    .content{
        width:32%;
        margin:20px 5px;
    }

    .content_image img{
        height:200px;
        max-width:100%;
    }

    .content_image{
        border:1px solid gray;
    }

    .contents_wrapper{
        text-align:center;
        display:flex;
        flex-wrap:wrap;
        width: 80%;
        margin: 0 auto;
        padding:50px 0;
    }

    .content_tag{
        background:linear-gradient(to top, #0000d2, #5bcaff);      
        border-radius: 30px;
        padding: 3px 10px;
        display: inline-block;
        margin-top: 10px;
        color:white;
    }

</style>