<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Helpers\Gambar;

class Post extends Model
{
    use HasFactory;
    public static $media =  'post';

    public function category(){

        return $this->belongsTo('App\Models\Blog\Category');
    }

    public function user(){

        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Blog\Tag');
    }

    static function create($request){

        try{

            $lastData = Post::orderBy('created_at','DESC')->first();
            if ($lastData == null) {
                $lastId = 1;
            }else{
                $lastId = $lastData->id;
            }
            
            $model = new Post;
            
            // upload image
            $image = Gambar::inputImage(Post::$media, $request->thumbnail);
            $model->image = $image;

            $model->title = $request->title;
            $model->slug = Str::slug($request->title, '-'); 
            $model->user_id = auth()->user()->id;
            $model->category_id = $request->category_id;
            $model->date = date('Y-m-d');
            $model->content = $request->content;
            $model->status = $request->status;
            $model->save();

            //multiple tag
            $model->tags()->sync($request->get('tags'));
            return true;
         }
         catch(\Exception $e){
           return false;
         }
    }

    static function edit($id, $request){
        // upload image
        $model = Post::find($id);
        if ($model->image != null) {
            $url = public_path().'/assets/img/post'.$model->image;
            if ((file_exists( $url ))) {
                unlink($url);
            }

        }
        
        $image = Gambar::inputImage(Post::$media, $request->thumbnail);
        $model->image = $image;

        $model->title = $request->title;
        $model->slug = Str::slug($request->title, '-'); 
        $model->user_id = auth()->user()->id;
        $model->category_id = $request->category_id;
        $model->date = date('Y-m-d');
        $model->content = $request->content;
        $model->status = $request->status;
        $model->save();

        //multiple tag
        $model->tags()->sync($request->get('tags'));
        try{

            
            return true;
        }
        catch(\Exception $e){
           return false;
        }
    }
}