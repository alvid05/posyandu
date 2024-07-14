<?php

namespace App\Models;
use DB;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model {
    protected $table = 'roles';

    public function users(){
    	return $this->hasOne('App\Models\Users','role_id');
    }

    
    static function create($request){
        try{
            $role = new Roles;
            $role->role = $request->role;
            $role->save();
            return true;
         }
         catch(\Exception $e){
           return false;
         }
    }

    static function edit($id, $request){
        try{
            $role = new Roles;
            $role = Roles::find($id);
            $role->role = $request->role;
            $role->save();
            return true;
        }
        catch(\Exception $e){
           return false;
        }
    }
}
?>