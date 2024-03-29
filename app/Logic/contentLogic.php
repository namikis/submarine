<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Model;
use App\Models\content;
use App\Logic\mailLogic;
use App\Models\Users;
use App\Models\Appro;

class contentLogic extends Model
{
    public static function getContents($keyword, $mode=null){
        $contents = array();

        if($keyword == ''){
            return $contents;
        }

        $searchArr = explode("　",$keyword);
        $searchArr2 = array();
        foreach($searchArr as $search){
            $searchArr2 = array_merge($searchArr2,explode(" ",$search));
        }
        $contents = content::getSearch($searchArr2, $mode);

        return $contents;

    }

    public static function preSaveImage($file){
        $file_name = $file->getClientOriginalName();
        $temp_path = public_path("img/temp");
        $file->move($temp_path,$file_name);

        return $file_name;
    }

    public static function saveImage($file_name){
        $time_file_name = time() . $file_name;
        $file_path = public_path('img/content');
        $temp_path = public_path("img/temp");
        rename($temp_path . "/" . $file_name, $file_path . "/" . $time_file_name);

        return $time_file_name;
    }

    public static function deleteImage($image_name){
        $file_path = public_path('img/content') . "/" . $image_name;

        if(file_exists($file_path)){
            unlink($file_path);
        }
    }

    public static function cleanUp($user_id){
        $plus_count = Users::getPlusCount($user_id) + 3;
        Users::updatePlusCount($user_id,$plus_count);
        // 返信メール送信
        $appro = Appro::getAppById($user_id);
        mailLogic::sendRepMail($appro->email,$appro->user_name,$plus_count);
        //同一ユーザーのリクエストは一旦全て消す
        Appro::deleteApp($user_id);
    }
}
