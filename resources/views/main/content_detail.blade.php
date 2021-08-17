@extends('layouts./header')

@if(app('env') != 'production')
    <link rel="stylesheet" href="{{asset('/css/contents.css')}}">
@else
    <link rel="stylesheet" href="{{secure_asset('/css/contents.css')}}">
@endif

@section('content')
    <div class="sea_wrapper">
    <div class="bread">{{$bread}}</div>

        <div class="container" id="app">
            <div class="detail_wrapper">
                <div class="detail_image">
                @if(app('env') != 'production')
                    <img src="{{asset('/img/content/'.$contents->image_name)}}">
                @else
                    <img src="{{  secure_asset('/img/content/'.$contents->image_name)  }}">
                @endif
                </div>
                <div class="content_menu_wrapper">
                    <div class="content_edit_wrapper">
                        @if(isset($loginInfo) && $loginInfo['user_id'] == $contents->company_id)
                            <div class="content_edit"><a href="{{ '/content/edit?id=' . $contents->id }}" class="button">edit</a></div>
                            <div class="content_delete">
                                <modal
                                    modal_mode = "{{ json_encode('content_del') }}"
                                    content_id = "{{ json_encode($contents->id) }}"
                                />
                            </div>
                            
                        @endif
                    </div>
                    <div class="content_favorite_wrapper">
                        <favo
                            login_info = "{{ json_encode($loginInfo) }}"
                            content_id = "{{ json_encode($contents->id) }}"
                        />
                    </div>
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
                        <p class="link_p"><a href="{{$contents->content_link}}">{{$contents->content_link}}</a></p>
                    @else
                        <p>記載なし</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
@endsection

@if(app('env') != 'production')
    <script src="{{asset('js/fav.js')}}"></script>
@else
    <script src="{{  secure_asset('js/fav.js')  }}"></script>
@endif