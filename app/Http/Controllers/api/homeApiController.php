<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\content;

class homeApiController extends Controller
{
    public function getVarious(){
        $contents = content::getVarious();
        $data['contents'] = $contents;
        return json_encode($data);
    }
}
