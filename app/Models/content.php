<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Logic\contentLogic;
use App\Models\Users;

class content extends Model
{
    protected $table = 'contents';
    protected $guarded = 'id';

    public static $rules = [
        'tag' => 'required',
        'link' => 'required',
        'detail' => 'required|max:500',
        'image' => 'required|image|file'
    ];

    public static function getVarious($mode=null){
        //ランダムに9件取得
        
        if($mode == 1){
            $contents = DB::table('auto_contents')
            ->select('auto_contents.image_url', 'auto_contents.id', 'auto_tag.tag')
            ->leftjoin('auto_tag','auto_contents.id', '=', 'auto_tag.content_id')
            ->inRandomOrder()
            ->limit(12)->get();
        }else{
            $select ="contents.image_name,tags.tag,contents.id";

        $contents = DB::table('contents')
            ->select(DB::raw($select))
            ->leftjoin('tags','contents.id', '=', 'tags.content_id')
            ->inRandomOrder()
            ->limit(12)->get();
        }
        
        return $contents;
    } 

    public static function getSearch($data, $mode){
        if($mode==1){
            $select="contents.image_name,tags.tag,contents.id";

            $contents = DB::table('auto_contents')
            ->select('auto_contents.image_url', 'auto_tag.tag', 'auto_contents.id')
            ->leftjoin('auto_tag','auto_contents.id', '=', 'auto_tag.content_id');

            foreach($data as $key){
                $contents = $contents->where('auto_tag.tag','like','%' . $key . '%');
            }
        }else{
            $select="contents.image_name,tags.tag,contents.id";

            $contents = DB::table('contents')
            ->select(DB::raw($select))
            ->leftjoin('tags','contents.id', '=', 'tags.content_id');

            foreach($data as $key){
                $contents = $contents->where('tags.tag','like','%' . $key . '%');
            }
            
        }
        $contents = $contents->distinct()->get();

        return $contents;
    }

    public static function getContentById($content_id, $mode=null){
        if($mode==1){
            $contents = DB::table('auto_contents')
            ->select('image_url', 'content_link', 'content_detail', 'auto_user_favorite.id as favo', 'company_id', 'auto_tag.tag as tag')
            ->leftjoin('auto_user_favorite','auto_contents.id','=','auto_user_favorite.content_id')
            ->leftjoin('auto_tag','auto_contents.id', '=', 'auto_tag.content_id')
            ->where('auto_contents.id','=',$content_id)
            ->first();
        }else{
            $select = "image_name,content_link,content_detail,user_favorite.id as favo,company_id,tags.tag as tag";

            $contents = DB::table('contents')
            ->select(DB::raw($select))
            ->leftjoin('user_favorite','contents.id','=','user_favorite.content_id')
            ->leftjoin('tags','contents.id', '=', 'tags.content_id')
            ->where('contents.id','=',$content_id)
            ->first();
        }

        return $contents;
    }

    public static function getFavoriteById($id, $mode=null){

        if($mode){
            $contents = DB::table('auto_contents')
            ->select('image_url', 'auto_tag.tag', 'auto_contents.id')
            ->leftjoin('auto_user_favorite','auto_contents.id','=','auto_user_favorite.content_id')
            ->leftjoin('users','users.id', '=', 'auto_user_favorite.user_id')
            ->leftjoin('auto_tag','auto_tag.content_id', 'auto_contents.id')
            ->where('users.id', '=', $id)
            ->get();
        }else{
            $select = "contents.image_name,tags.tag,contents.id";

            $contents = DB::table('contents')
            ->select(DB::raw($select))
            ->leftjoin('user_favorite','contents.id','=','user_favorite.content_id')
            ->leftjoin('users','users.id', '=', 'user_favorite.user_id')
            ->leftjoin('tags','tags.content_id', 'contents.id')
            ->where('users.id', '=', $id)
            ->get();
        }

        return $contents;
    }

    public static function update_favoById($content_id,$user_id, $mode=null){

        //$user_favorite_id = getFavorite($content_id,$user_id);

        if($mode){
            $table = "auto_user_favorite";
        }else{
            $table = "user_favorite";
        }

        $select = "id";
        $user_favorite_id = DB::table($table)
                        ->select(DB::raw($select))
                        ->where('content_id', "=", $content_id)
                        ->where('user_id', "=", $user_id)
                        ->first();

        if($user_favorite_id == null){
            $data = array(
                'user_id' => $user_id,
                'content_id' => $content_id
            );

            DB::table($table)->insert($data);
        }else{
            DB::table($table)
            ->where('id',$user_favorite_id->id)->delete();
        }
        
    }

    //for vue.
    public static function getFavorite($content_id, $user_id, $mode=null){
        if($mode){
            $table = "auto_user_favorite";
        }else{
            $table = "user_favorite";
        }
        $select = "id";
        $favorite_id = DB::table($table)
                        ->select(DB::raw($select))
                        ->where('content_id', "=", $content_id)
                        ->where('user_id', "=", $user_id)
                        ->first();
        return $favorite_id;
    }

    public static function insertContent($data, $tag){
        DB::table('contents')->insert($data);
        $content_id = DB::getPdo()->lastInsertId();

        $data2 = array(
            "content_id" => $content_id,
            "tag" => $tag
        );
        DB::table("tags")->insert($data2);
        Users::updatePlusCount($data['company_id'], Users::getPlusCount($data['company_id']) - 1);
    }

    public static function getAllTags($mode=null){
        if($mode==1){
            $tags = DB::table('auto_tag')
                    ->select('tag')->distinct()
                    ->get();
        }else{
            $tags = DB::table('tags')
                    ->select('tag')->distinct()
                    ->get();
        }
        return $tags;
    }

    public static function getMyContents($user_id, $mode=null){
        if($mode){
            $contents = DB::table('auto_contents')
                        ->select('auto_contents.image_url','auto_tag.tag','auto_contents.id')
                        ->leftjoin('auto_tag','auto_contents.id', '=', 'auto_tag.content_id')
                        ->where('auto_contents.company_id',$user_id)
                        ->get();
        }else{
            $contents = DB::table('contents')
                        ->select('contents.image_name','tags.tag','contents.id')
                        ->leftjoin('tags','contents.id', '=', 'tags.content_id')
                        ->where('contents.company_id',$user_id)
                        ->get();
        }
        
        return $contents;
    }

    public static function updateContent($content_id,$data,$tag){
        DB::table('contents')
                ->where('id', $content_id)
                ->update($data);
        DB::table('tags')
                ->where('content_id',$content_id)
                ->update(["tag" => $tag]);
    }

    public static function getCompany($content_id){
        return DB::table('contents')
                ->select('company_id')
                ->where('id',$content_id)
                ->first();
    }

    public static function deleteContent($content_id, $mode=null){
        if($mode){
            $content_table = "auto_contents";
            $tag_table = "auto_tag";
        }else{
            //delete image file
            $image_name = DB::table('contents')
            ->select('image_name')->where('id', $content_id)->first()->image_name;
            contentLogic::deleteImage($image_name);
            $content_table = "contents";
            $tag_table = "tags";
        }
        
        DB::table($content_table)->where('id', $content_id)->delete();
        DB::table($tag_table)->where('content_id',$content_id)->delete();
        logger($content_id);

    }

    public static function deleteContentsById($company_id){
        //delete all images with the account
        $contents = DB::table('contents')
                        ->select('id','image_name')->where('company_id', $company_id)->get();
        foreach($contents as $content){
            contentLogic::deleteImage($content->image_name);
            DB::table('tags')->where('content_id',$content->id)->delete();
        }
        DB::table('contents')->where('company_id', $company_id)->delete();
    }
}
