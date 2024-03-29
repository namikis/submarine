<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\content;
use App\Logic\userLogic;
use App\Models\Appro;
use App\Logic\contentLogic;

class contentController extends Controller
{
    public function insert_form(){
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
        }
        if(!(userLogic::calcPlusCount($loginInfo['user_id']))){
            return view('approval_mail_form')
                    ->with('loginInfo', $loginInfo)
                    ->with('bread', 'approval-mail');
        }
        return view('main/content_insert_form')
                ->with('loginInfo', $loginInfo)
                ->with('bread', 'add-content');
    }

    public function preview_form(Request $request){
        $this->validate($request, content::$rules);
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
        }

        $file_name = contentLogic::preSaveImage($request->image);

        $contents = array(
            "tag" => $request->tag,
            "link" => $request->link,
            "detail" => $request->detail,
            "image" => $file_name
        );
        return view('main/content_insert_form')
                ->with('contents', $contents)
                ->with('loginInfo', $loginInfo)
                ->with('bread','preview');
    }

    public function insert(Request $request){
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
        }

        $file_name = contentLogic::saveImage($request->image);

        $contents = array(
            "content_link" => $request->link,
            "content_detail" => $request->detail,
            "image_name" => $file_name,
            "company_id" => $loginInfo['user_id'],
            "tag_id" => 1
        );
        content::insertContent($contents, $request->tag);

        return view('main/content_insert_form')
                ->with('loginInfo', $loginInfo)
                ->with('bread','content-added');
    }

    public function content_edit(Request $request){
        $content_id = $request->id;
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
        }
        $contents = content::getContentById($content_id);
        $contents->id = $content_id;
        return view('main/content_insert_form')
                    ->with('loginInfo', $loginInfo)
                    ->with('bread','edit')
                    ->with('contents',$contents);
    }

    public function content_edit_done(Request $request){
        $this->validate($request,[
            'tag' => 'required',
            'link' => 'required',
            'detail' => 'required|max:500',
        ]);
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
        }
        $content_id = $request->content_id;
        $data = array(
            "content_link" => $request->link,
            "content_detail" => $request->detail
        );
        content::updateContent($content_id,$data,$request->tag);

        return redirect("/account");
    }

    public function content_delete(Request $request){
        $loginInfo = session('loginInfo');
        $content_id = $request->id;
        if($request->auto == 1){
            content::deleteContent($content_id, 1);
        }else{
            $company_id = content::getCompany($content_id)->company_id;
            if(!isset($loginInfo) || $loginInfo['user_id'] != $company_id){
                return redirect('/signIn');
            }
            content::deleteContent($content_id);
        }
        
        return redirect("/account");
    }

    public function approval(Request $request){
        $remember = $request->token;
        $request_user_id = Appro::getIdByToken($remember);
        return view('approval_form')
                ->with('user_id',$request_user_id)
                ->with('bread', 'approval');
    }

    public function approval_done(Request $request){
        $user_id = $request->id;
        contentLogic::cleanUp($user_id);
        $done_message = "承認完了。";
        return view('exe_done')
                    ->with('bread','approval-done')
                    ->with('done_message', $done_message);
    }
}
