<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\MailSend;
use App\Mail\repMailSend;
use App\Models\Appro;

class mailLogic extends Model
{
    use HasFactory;

    public static function sendApproMail($rep_email){
        $loginInfo = session('loginInfo');
        $remember = substr(bin2hex(random_bytes(16)), 0, 16);
        Appro::insertRequest($loginInfo['user_id'],$rep_email,$remember);

        $root_email = "koudoldk@icloud.com";

        Mail::to($root_email)->send(new MailSend($loginInfo['user_name'],$loginInfo['user_id'],$remember));
    }

    public static function sendRepMail($to_email,$to_user_name,$plus_count){
        Mail::to($to_email)->send(new repMailSend($to_user_name,$plus_count));
    }
}
