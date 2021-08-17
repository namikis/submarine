<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mailLogic extends Model
{
    use HasFactory;

    public static function getApproMailBody($user_name,$user_id,$remember_token=null){
        $body = "
            <p>コンテンツ追加の承認リクエストです。</p>
            <p>ユーザー情報</p>
            <p>ユーザーID：
        " . $user_id . "</p>
            <p>ユーザー名：
        " . $user_name ."</p>";
        //廃棄
    }
}
