<?php

namespace App\Models;
use DB;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class LaporanPintar extends Model {
    protected $table = 'laporan_pintar';

    public function users(){
    	return $this->hasOne('App\Models\Users','role_id');
    }

    
    static function create($request){
        try{
            $role = new Laporan;
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
            $role = new Laporan;
            $role = Laporan::find($id);
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