<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class userLogic extends Model
{
    use HasFactory;

    public static function calcPlusCount($user_id){
        $plus_count = Users::getPlusCount($user_id);
        if($plus_count <= 0){
            return false;
        }else{
            Users::updatePlusCount($user_id,$plus_count-1);
            return true;
        }
    }
}
