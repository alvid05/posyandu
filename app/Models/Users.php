<?php

namespace App\Models;
use DB;
use App\Models\Comments;
use App\Models\CommentReplies;
use App\Models\LikedComments;
use App\Models\Roles;
use App\Helpers\Gambar;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Users extends Model {
    protected $table = 'users';
    public static $media =  'users';
    protected $guarded = [];


    public function roles(){
    	return $this->belongsTo('App\Models\Roles','role_id','id');
    }

    public function audit()
    {
        return $this->belongsTo(Users::class,'audit_id','id');
    }

    static function create($request){
        $encryptPassword = bcrypt($request->password);
        $user = new Users;

        $user->email = $request->email;
        $user->name = $request->username;
        $user->category_id = $request->jenis_pilar;
        $user->gruup_name = $request->nama_kelompok;
        $user->wilayah = $request->wilayah;
//        $user->status = $request->status;
        if(isset($request->role_id)){
            $user->role_id = $request->role_id;
            $user->is_active = $request->is_active;
            $name = Gambar::inputImage(Users::$media, $request->avatar);
            $user->avatar = $name;
        }else{
            $user->role_id = 2;
            $user->is_active = 'Active';
        }

        $user->password = $encryptPassword;

        $user->remember_token = $request->_token;

        $saveUser = $user->save();
        if($saveUser == true){
            return true;
        }else{
            return false;
        }
    }

    static function edit($id, $request){

        $user = new Users;
        $user = Users::find($id);

        $user->email = $request->email;
        $user->name = $request->username;
        $user->category_id = $request->jenis_pilar;
        $user->group_name = $request->nama_kelompok;
        $user->wilayah = $request->wilayah;
        $user->phone_number = $request->phone_number;
//        $user->status = $request->status;

        if(isset($request->role_id)){
            $user->role_id = $request->role_id;
            $user->is_active = $request->is_active;
            $name = Gambar::inputImage(Users::$media, $request->avatar);
            $user->avatar = $name;

        }else if($request->role_id == null && auth()->user()->role_id != null){
            $user->role_id = $user->role_id;
            $user->is_active =  $user->is_active;
            $name = Gambar::inputImage(Users::$media, $request->avatar);
            $user->avatar = $name;
        }
        else{
            $user->role_id = 2;
            $user->is_active = 'Active';
        }
//        if($request->password != null){
//            $encryptPassword = bcrypt($request->password);
//            $user->password = $encryptPassword;
//        }


        $user->remember_token = $request->_token;

        $saveUser = $user->save();
        if($saveUser == true){
            return true;
        }else{
            return false;
        }
    }

    static function profile($id, $request){

        $user = Users::find($id);

        $user->email = $request->email;
        $user->name = $request->username;
        $user->category_id = $request->jenis_pilar;
        $user->group_name = $request->nama_kelompok;
        $user->wilayah = $request->wilayah;
//        $user->status = $request->status;

        $name = Gambar::inputImage(Users::$media, $request->avatar);
        $user->avatar = $name;

        if($request->password != null){
            $encryptPassword = bcrypt($request->password);
            $user->password = $encryptPassword;
        }


        $user->remember_token = $request->_token;

        $saveUser = $user->save();
        if($saveUser == true){
            return true;
        }else{
            return false;
        }
    }
    public function categoryPillar()
    {
        return $this->belongsTo(CategoryPillar::class,'category_id','id');
    }
}
?>
