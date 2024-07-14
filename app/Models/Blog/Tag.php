<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany('App\Models\Blog\Post');
    }

    static function create($request){

        try{

            $model = new Tag;

            $model->name = $request->name;
            $model->type = $request->type;
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

            $model = Tag::find($id);

            $model->name = $request->name;
            $model->type = $request->type;
            $model->status = $request->status;
            $model->save();

            return true;
        }
        catch(\Exception $e){
           return false;
        }
    }
}