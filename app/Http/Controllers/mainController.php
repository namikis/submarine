<?php

namespace App\Http\Controllers;

use App\Models\content;
use Illuminate\Http\Request;

class mainController extends Controller
{
    //検索結果を表示
    public function search(Request $request){
        $loginInfo = session('loginInfo');
        
        return view('main.search')
        ->with('loginInfo',$loginInfo)
        ->with('keywords',$request->keyword)
        ->with('bread','search');
    }

    //お気に入り登録したものを表示
    public function favorite(){
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
        }
        $user_id = $loginInfo['user_id'];

        return view('main.favorite')
        ->with('loginInfo',$loginInfo)
        ->with('keywords','')
        ->with('bread','favorite');
    }

    //DBからランダムに表示
    public function various(){
        $loginInfo = session('loginInfo');
        
        return view('main.various')
        ->with('loginInfo',$loginInfo)
        ->with('bread','various')
        ->with('keywords','');
    }

    public function detail(Request $request){
        $loginInfo = session('loginInfo');
        $content_id = $request->id;

        $contents = content::getContentById($content_id);
        $contents->id = $content_id;

        if(file_exists(__DIR__ . "/../../../public/img/content/" . $contents->image_name) == false){
            $contents->image_name = "deleted_image.png";
        }

        return view('main.content_detail')
        ->with('loginInfo',$loginInfo)
        ->with('contents',$contents)
        ->with('bread','detail');
    }

    //  Vueに移行
    // public function update_favo(Request $request){
    //     $loginInfo = session('loginInfo');
    //     if(!isset($loginInfo)){
    //         return redirect('/signIn');
    //     }

    //     content::update_favoById($request->content_id,$loginInfo['user_id']);

    //     return redirect()->back();
    // }
}
