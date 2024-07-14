<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Gambar;

class Category extends Model
{
    use HasFactory;
    public static $media =  'category';

    public function user(){

        return $this->belongsTo('App\Models\User');
    }

    static function create($request){

        try{

            $model = new Category;
            
            // upload image
            $image = Gambar::inputImage(Category::$media, $request->image);
            $model->image = $image;

            $model->name = $request->name;
            $model->desc = $request->desc;
            $model->user_id = auth()->user()->id;
            $model->status = $request->status;
            $model->save();
            
            return true;
         }
         catch(\Exception $e){
           return false;
         }
    }

    static function edit($id, $request){
        
        try{

            // upload image
            $model = Category::find($id);
            $url = public_path().'/assets/img/category'.$model->image;
            if ((file_exists( $url ))) {
                unlink($url);
            }

            $image = Gambar::inputImage(Category::$media, $request->image);
            $model->image = $image;

            $model->name = $request->name;
            $model->desc = $request->desc;
            $model->user_id = auth()->user()->id;
            $model->status = $request->status;
            $model->save();

            return true;
        }
        catch(\Exception $e){
           return false;
        }
    }
}