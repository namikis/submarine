<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailSend;
use App\Models\Appro;
use App\Logic\mailLogic;

class mailSendController extends Controller
{
    public function sendApproMail(Request $request){
        $this->validate($request, ["email" => "required"]);
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
        }

        $rep_email = $request->email;
        mailLogic::sendApproMail($rep_email);
        $done_message = "リクエストを送信しました。返信メールが届くまでもうしばらくお待ちください。";

        return view('exe_done')
                ->with('bread', 'request-sended')
                ->with('loginInfo', $loginInfo)
                ->with('done_message', $done_message);
    }
}
