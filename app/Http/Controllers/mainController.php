<?php

namespace App\Http\Controllers;

use App\Models\content;
use Illuminate\Http\Request;

class mainController extends Controller
{
    //検索結果を表示
    public function search(Request $request){

        $loginInfo = session('loginInfo');
        $contents = array();
        $search = $request->keyword;

        if($search[0] == ''){
            return view('main.search')
                ->with('contents',$contents)
                ->with('loginInfo',$loginInfo)
                ->with('bread','search');
        }
        
        $search1 = explode("　", $search);
        $search2 = array();
        foreach($search1 as $search){
            $search2 = array_merge($search2, explode(" ", $search));
        }
        
        $contents = content::getSearch($search2);
        $search_flag = 1;

        return view('main.search')
        ->with('contents',$contents)
        ->with('loginInfo',$loginInfo)
        ->with('search_flag',$search_flag)
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

        $contents = content::getFavoriteById($user_id);

        return view('main.favorite')
        ->with('loginInfo',$loginInfo)
        ->with('contents',$contents)
        ->with('bread','favorite');
    }

    //DBからランダムに表示
    public function various(){
        $loginInfo = session('loginInfo');
        $various_flag = 1;
        $contents = content::getVarious();
        return view('main.various')
        ->with('loginInfo',$loginInfo)
        ->with('various_flag',$various_flag)
        ->with('bread','various')
        ->with('contents', $contents)
        ->with('keywords','');
    }

    public function detail(Request $request){
        $loginInfo = session('loginInfo');
        $content_id = $request->id;

        $contents = content::getContentById($content_id);
        $contents->id = $content_id;

        return view('main.content_detail')
        ->with('loginInfo',$loginInfo)
        ->with('contents',$contents)
        ->with('bread','detail');
    }

    public function update_favo(Request $request){
        $loginInfo = session('loginInfo');
        if(!isset($loginInfo)){
            return redirect('/signIn');
        }

        content::update_favoById($request->content_id,$loginInfo['user_id']);

        return redirect()->back();
    }
}
