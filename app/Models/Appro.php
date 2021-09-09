<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appro extends Model
{
    use HasFactory;

    public static function insertRequest($user_id, $email, $remember_token){
        $data = array(
            'user_id' => $user_id,
            "email" => $email,
            "remember_token" => $remember_token
        );
        DB::table('temp_approvals')
                ->insert($data);
    }

    public static function getIdByToken($token){
        return DB::table('temp_approvals')
                    ->select('user_id')
                    ->where('remember_token',$token)->first();
    }

    public static function getAppById($user_id){
        return DB::table('temp_approvals')
                    ->select('temp_approvals.email as email','users.user_name as user_name')
                    ->leftjoin('users','temp_approvals.user_id','users.id')
                    ->where('temp_approvals.user_id',$user_id)->first();
    }

    public static function deleteApp($user_id){
        DB::table('temp_approvals')
                ->where('user_id',$user_id)
                ->delete();
    }
}
