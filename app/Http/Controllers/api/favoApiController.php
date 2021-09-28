<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\content;

class favoApiController extends Controller
{
    public function getFavo(Request $request){
        $content_id = $request->content_id;
        $user_id = $request->user_id;

        $favo_id = content::getFavorite($content_id,$user_id);
        $data['favoId'] = $favo_id;
        return json_encode($data);
    }

    public function updateFavo(Request $request){
        $content_id = $request->content_id;
        $user_id = $request->user_id;

        content::update_favoById($content_id,$user_id);
        return json_encode(true);
    }

    public function getAutoFavo(Request $request){
        $content_id = $request->content_id;
        $user_id = $request->user_id;

        $favo_id = content::getFavorite($content_id,$user_id, 1);
        $data['favoId'] = $favo_id;
        return json_encode($data);
    }

    public function updateAutoFavo(Request $request){
        $content_id = $request->content_id;
        $user_id = $request->user_id;

        content::update_favoById($content_id,$user_id, 1);
        return json_encode(true);
    }
}
