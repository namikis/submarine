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

    public function getTags(){
        $data['tags'] = content::getAllTags();
        return json_encode($data);
    }

    public function getMyContents(Request $request){
        $data['contents'] = content::getMyContents($request->user_id);
        return json_encode($data);
    }
}
