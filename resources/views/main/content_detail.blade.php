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
                @if(isset($contents->image_name))
                    @if(app('env') != 'production')
                        <img src="{{asset('/img/content/'.$contents->image_name)}}">
                    @else
                        <img src="{{  secure_asset('/img/content/'.$contents->image_name)  }}">
                    @endif
                @else
                    <img src="{{ $contents->image_url }}" alt="">
                @endif
                </div>
                <div class="content_menu_wrapper">
                    <div class="content_edit_wrapper">
                        @if(isset($loginInfo) && $loginInfo['user_id'] == $contents->company_id)
                            @if(isset($contents->image_name))
                                <div class="content_edit"><a href="{{ '/content/edit?id=' . $contents->id }}" class="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
                                <div class="content_delete">
                                    <modal
                                        modal_mode = "{{ json_encode('content_del') }}"
                                        content_id = "{{ json_encode($contents->id) }}"
                                        auto_flag = "{{ json_encode(false) }}"
                                    />
                                </div>
                            @else
                                <div class="content_delete">
                                    <modal
                                        modal_mode = "{{ json_encode('content_del') }}"
                                        content_id = "{{ json_encode($contents->id) }}"
                                        auto_flag = "{{ json_encode(true) }}"
                                    />
                                </div>
                            @endif
                            
                        @endif
                    </div>
                    <div class="content_favorite_wrapper">
                        @if(isset($contents->image_url))
                            <favo
                                login_info = "{{ json_encode($loginInfo) }}"
                                content_id = "{{ json_encode($contents->id) }}"
                                auto_flag = "{{ json_encode(true) }}"
                            />
                        @else
                            <favo
                                login_info = "{{ json_encode($loginInfo) }}"
                                content_id = "{{ json_encode($contents->id) }}"
                                auto_flag = "{{ json_encode(false) }}"
                            />
                        @endif
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