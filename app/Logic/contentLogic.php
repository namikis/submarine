<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Model;
use App\Models\content;

class contentLogic extends Model
{
    public static function getContents($keyword){
        $contents = array();

        if($keyword == ''){
            return $contents;
        }

        $searchArr = explode("　",$keyword);
        $searchArr2 = array();
        foreach($searchArr as $search){
            $searchArr2 = array_merge($searchArr2,explode(" ",$search));
        }
        $contents = content::getSearch($searchArr2);

        return $contents;

    }
}
