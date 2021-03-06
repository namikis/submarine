<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class content extends Model
{
    protected $table = 'contents';
    protected $guarded = 'id';

    public static function getVarious(){
        //ランダムに9件取得
        $select ="contents.image_name,tags.tag,contents.id";

        $contents = DB::table('contents')
            ->select(DB::raw($select))
            ->leftjoin('tags','contents.id', '=', 'tags.content_id')
            ->inRandomOrder()
            ->limit(9)->get();
        
        return $contents;
    } 

    public static function getSearch($data){
        $select="contents.image_name,tags.tag,contents.id";

        $contents = DB::table('contents')
        ->select(DB::raw($select))
        ->leftjoin('tags','contents.id', '=', 'tags.content_id');

        foreach($data as $key){
            $contents = $contents->where('tags.tag','like','%' . $key . '%');
        }
        
        $contents = $contents->distinct()->get();

        return $contents;
    }

    public static function getContentById($content_id){
        $select = "image_name,content_link,content_detail,user_favorite.id as favo";

        $contents = DB::table('contents')
        ->select(DB::raw($select))
        ->leftjoin('user_favorite','contents.id','=','user_favorite.content_id')
        ->where('contents.id','=',$content_id)
        ->first();

        return $contents;
    }

    public static function getFavoriteById($id){
        $select = "contents.image_name,tags.tag,contents.id";

        $contents = DB::table('contents')
        ->select(DB::raw($select))
        ->leftjoin('user_favorite','contents.id','=','user_favorite.content_id')
        ->leftjoin('users','users.id', '=', 'user_favorite.user_id')
        ->leftjoin('tags','tags.content_id', 'contents.id')
        ->where('users.id', '=', $id)
        ->get();

        return $contents;
    }

    //js導入で消す
    public static function update_favoById($content_id,$user_id){
        $select = "id";

        $user_favorite_id = DB::table('user_favorite')
        ->select(DB::raw($select))
        ->where('content_id', '=', $content_id)
        ->where('user_id', '=', $user_id)
        ->first();

        if($user_favorite_id == null){
            $data = array(
                'user_id' => $user_id,
                'content_id' => $content_id
            );

            DB::table('user_favorite')->insert($data);
        }else{
            DB::table('user_favorite')
            ->where('id',$user_favorite_id->id)->delete();
        }
        
    }
}
