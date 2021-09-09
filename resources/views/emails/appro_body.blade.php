<p>コンテンツ投稿の承認リクエストです。</p>
<p>・ユーザー情報</p>
<p>ユーザーID：{{ $user_id }}</p>
<p>ユーザー名：{{ $user_name }}</p>
<br>
<p>承認用URL：</p>
@if(app('env') != production)
    <p><a href="http://localhost:8000/content/appro?token={{ $remember }}">http://localhost:8000/content/appro?token={{ $remember }}</a></p>
@else
    <p><a href="https://submarine21.herokuapp.com/content/appro?token={{ $remember }}">https://submarine21.herokuapp.com/content/appro?token={{ $remember }}</a></p>
