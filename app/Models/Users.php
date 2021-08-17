<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected $table = 'users';

    public static function getById($email){
        $select = "
            id,
            user_name
        ";

        $user = DB::table('users')
        ->select(DB::raw($select))
        ->where('email',$email)
        ->first();

        return $user;

    }

    public static function insertUser($data){
        DB::table('users')->insert($data);
        $id = DB::getPdo()->lastInsertId();

        return $id;
    }

    public static function updateData($data){
        DB::table('users')
        ->where('id',$data['id'])
        ->update($data);
    }

    public static function deleteData($loginInfo){
        DB::table('users')
        ->where('id',$loginInfo['user_id'])
        ->delete();
    } 

    public static function getPlusCount($user_id){
        return DB::table('users')
                ->select('plus_count')->where('id',$user_id)->first()->plus_count;
    }

    public static function updatePlusCount($user_id,$plus_count){
        DB::table('users')
            ->where('id',$user_id)->update(["plus_count" => $plus_count]);
    }
}
