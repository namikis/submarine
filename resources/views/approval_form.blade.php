@extends('layouts/header')
@section('content')
    <div class="bread">{{ $bread }}</div>
    <div class="container">
        <div class="approval_wrapper">
            @if($user_id != null)
                <a href="/content/approval/done?id={{ $user_id->user_id }}" class="app_button">承認する</a>
            @else
                <p>承認済み</p>
            @endif
        </div>
        
    </div>
@endsection

<style>
    .approval_wrapper{
        padding-top:30px;
        text-align:center;
    }

    .app_button{
        font-size:24px;
    }
</style>