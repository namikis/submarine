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
}
