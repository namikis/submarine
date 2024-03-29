@if(app('env') != 'production')
    <link rel="stylesheet" href="{{ asset('css/insert_contents.css') }}">
@else
    <link rel="stylesheet" href="{{ secure_asset('css/insert_contents.css') }}">
@endif
@extends('../layouts/header')
@section('content')
    <div class="bread" id="bread">
        {{ $bread }}
    </div>
    <div class="container">
        @if($bread == 'add-content')
        <form action="/content/preview" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form_wrapper">
                <div class="image_wrapper form_item">
                    <p>画像を選択してください。（必須）</p>
                    <div class="img_form">
                        <input type="file" name="image" accept="image/*" onchange="GetPreview(this);">
                        <div class="content_image">
                            <img src="" id="preview" alt="">
                        </div>
                    </div>
                </div>
                <div class="tag_wrapper form_item">
                    <p>コンテンツのタグ（ジャンル）を入力してください。</p>
                    <div class="tag_form text">
                        <input type="text" name="tag" placeholder="「プログラミング」,「書籍」, etc...">
                    </div>
                </div>
                <div class="link_wrapper form_item">
                    <p>コンテンツのリンクを貼ってください。</p>
                    <div class="link_form text">
                        <input type="text" name="link" placeholder="URL">
                    </div>
                </div>
                <div class="detail_wrapper form_item">
                    <p>コンテンツについて、詳しく説明してください。</p>
                    <div class="detail_form">
                        <textarea name="detail" cols="60" rows="10" placeholder="max:200"></textarea>
                    </div>
                </div>
                <div class="send_wrapper form_item">
                    <input type="submit" value="プレビュー">
                </div>
        </form>
        @elseif($bread == 'preview')
        <form action="/content/insert" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form_wrapper">
                <div class="pre_image">
                    <p>{{ $contents['image']  }}</p>
                    @if(app('env') != 'production')
                        <img src="{{ asset('img/temp/' . $contents['image']) }}" alt="" class="pre_image">
                    @else
                        <img src="{{ secure_asset('img/temp/' . $contents['image']) }}" alt="" class="pre_image">
                    @endif
                </div>
                <div class="tag_wrapper form_item">
                    <p>タグ　：　{{ $contents['tag'] }}</p>
                </div>
                <div class="link_wrapper form_item">
                    <p class="link_p">リンク　：　{{ $contents['link'] }}</p>
                </div>
                <div class="detail_wrapper form_item">
                    <p>詳細</p>
                    <p class="detail_field">{{ $contents['detail'] }}</p>
                </div>
                <div class="send_wrapper form_item">
                    <h4>上記の内容で登録しますか？</h4>
                    <input type="submit" value="登録する">
                </div>
                <input type="hidden" value="{{ $contents['tag'] }}" name="tag">
                <input type="hidden" value="{{ $contents['link'] }}" name="link">
                <input type="hidden" value="{{ $contents['detail'] }}" name="detail">
                <input type="hidden" value="{{ $contents['image'] }}" name="image">

        </form>
        @elseif($bread == 'content-added')
            <p>登録が完了しました。</p>
            <p><a href="/home">トップページへ</a></p>
        @elseif($bread == 'edit')
        <form action="/content/edit" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form_wrapper">
                <div class="image_wrapper form_item">
                    <p>画像を変える場合は作り直してください。</p>
                    <div class="img_form">
                        <div class="content_image">
                            @if(app('env') != 'production')
                                <img src="{{ asset('img/content/' . $contents->image_name) }}" alt="" class="pre_image">
                            @else
                                <img src="{{ secure_asset('img/content/' . $contents->image_name) }}" alt="" class="pre_image">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tag_wrapper form_item">
                    <p>コンテンツのタグ（ジャンル）を入力してください。</p>
                    @if($errors->has('tag'))
                        <p class="error_message">{{ $errors->first('tag') }}</p>
                    @endif
                    <div class="tag_form text">
                        <input type="text" name="tag" placeholder="「プログラミング」,「書籍」, etc..." value="{{ $contents->tag }}">
                    </div>
                </div>
                <div class="link_wrapper form_item">
                    <p>コンテンツのリンクを貼ってください。</p>
                    @if($errors->has('link'))
                        <p class="error_message">{{ $errors->first('link') }}</p>
                    @endif
                    <div class="link_form text">
                        <input type="text" name="link" placeholder="URL" value="{{ $contents->content_link }}">
                    </div>
                </div>
                <div class="detail_wrapper form_item">
                    <p>コンテンツについて、詳しく説明してください。</p>
                    @if($errors->has('detail'))
                        <p class="error_message">{{ $errors->first('detail') }}</p>
                    @endif
                    <div class="detail_form">
                        <textarea name="detail" cols="60" rows="10" placeholder="max:500">{{ $contents->content_detail }}</textarea>
                    </div>
                </div>
                <div class="send_wrapper form_item">
                    <input type="submit" value="変更する">
                </div>
                <input type="hidden" name="content_id" value="{{ $contents->id }}">
        </form>
        @endif
    </div>
@endsection


<script>
    var bread = document.getElementById('bread').textContent;
    console.log("test" + bread);
    function GetPreview(image_data){
        var fileReader = new FileReader();
        fileReader.onload = (function(){
            document.getElementById('preview').src = fileReader.result;
        });
        fileReader.readAsDataURL(image_data.files[0]);
    }
</script>
