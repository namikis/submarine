<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\content;
use App\Logic\contentLogic;

class contentController extends Controller
{
    public function insert_form(){
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
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
}
