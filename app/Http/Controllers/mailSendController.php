<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailSend;
use App\Models\Appro;

class mailSendController extends Controller
{
    public function sendApproMail(Request $request){
        $this->validate($request, ["email" => "required"]);
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
        }
        $rep_email = $request->email;
        $remember = substr(bin2hex(random_bytes(16)), 0, 16);
        Appro::insertRequest($loginInfo['user_id'],$rep_email,$remember);

        $root_email = "koudoldk@icloud.com";

        Mail::to($root_email)->send(new MailSend($loginInfo['user_name'],$loginInfo['user_id'],$remember));
        return redirect('/home');
    }
}
