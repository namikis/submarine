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
}
