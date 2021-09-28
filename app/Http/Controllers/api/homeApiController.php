<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\content;
use App\Logic\contentLogic;

class homeApiController extends Controller
{
    public function getVarious(){
        $contents = content::getVarious();
        $data['contents'] = $contents;
        return json_encode($data);
    }

    public function getSearch(Request $request){
        $keyword = $request->keyword;
        $data['contents'] = contentLogic::getContents($keyword);
        return json_encode($data);
    }

    public function getFavorite(Request $request){
        $user_id = $request->user_id;
        $data['contents'] = content::getFavoriteById($user_id);
        return json_encode($data);
    }

    public function getAutoVarious(){
        $contents = content::getVarious(1);
        $data['contents'] = $contents;
        return json_encode($data);
    }

    public function getAutoSearch(Request $request){
        $keyword = $request->keyword;
        $data['contents'] = contentLogic::getContents($keyword, 1);
        return json_encode($data);
    }

    public function getAutoFavorite(Request $request){
        $user_id = $request->user_id;
        $data['contents'] = content::getFavoriteById($user_id, 1);
        return json_encode($data);
    }

    public function getTags(){
        $data['tags'] = content::getAllTags();
        return json_encode($data);
    }

    public function getAutoTags(){
        $data['tags'] = content::getAllTags(1);
        return json_encode($data);
    }

    public function getMyContents(Request $request){
        $data['contents'] = content::getMyContents($request->user_id);
        return json_encode($data);
    }

    public function getMyAutoContents(Request $request){
        $data['contents'] = content::getMyContents($request->user_id, 1);
        return json_encode($data);
    }
}
