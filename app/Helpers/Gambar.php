<?php

namespace App\Helpers;
use DB;
use File;
use Image;
use Illuminate\Http\Request;
use App\Helpers\Navigation;
use Illuminate\Support\Facades\Storage;

class Gambar{
    //class untuk mengencode dari gambar(png,jpg) ke base64 untuk ditampilkan difilepond 
    static function encodeFromMedia($media, $gambar)
    {
        if (filled($gambar)) {
            $path = public_path('assets/img/'.$media.'/'.$gambar);
            $name = $gambar;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = File::get($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        }else{
            $base64 = null;
            return $base64;
        } 
    }

    static function encodeFromJson($gambar){
        if (filled($gambar)) {
            $json = json_decode($gambar, true)['data'];
            $type = json_decode($gambar, true)['type'];
            $base64 ='data:' . $type . ';base64,' . $json;
            return $base64;
        }else{
            $base64 = null;
            return $base64;
        }
     
    }

    static function inputImage($media, $gambar){
        date_default_timezone_set("Asia/Jakarta");
        $month = date('m');
        $year = date('Y');
        $rand = rand(0,999);

        if (filled($gambar)) {
            $data = json_decode($gambar, true)['data'];
            $type = (json_decode($gambar, true)['type']);
            $explode_type = explode('/',$type);
            $type_img = $explode_type[1];
            $img_name_db = '/'.$year.$month.'/'.time().'-'.$rand.'.'.$type_img;
            $img_name = time().'-'.$rand.'.'.$type_img;
            $path = public_path('assets/img/'.$media.'/'.$year.$month.'/');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
                Image::make($data)->save($path.$img_name);
            }else{
                Image::make($data)->save($path.$img_name);
            }
            return $img_name_db;
        }else{
            $img_name_db = null;
            return $img_name_db ;
        }
    }

}
