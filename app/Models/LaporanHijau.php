<?php

namespace App\Models;
use DB;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class LaporanHijau extends Model {
    protected $table = 'laporan_hijau';

    protected $guarded = [];

    public function users(){
    	return $this->hasOne('App\Models\Users','role_id');
    }


    static function create($request){
        try{
            $add = new LaporanHijau();
            $add->periode = $request->periode;
            $add->konversi_penyu = $request->konversi;
            $add->jml_telur_ditemukan = $request->jml_telur_ditemukan;
            $add->jml_telur_menetas	 = $request->jml_telur_menetas;
            $add->jml_tukik_dilepas	 = $request->jml_tukik_dilepas;
            $add->jml_pengunjung	 = $request->jml_pengunjung;
            $add->jenis_penyu		 = $request->jenis_penyu;
            $add->inovasi_program	 = $request->inovasi_program;
            $add->user_id	 = auth()->user()->id;
            $add->save();
            return 'success';
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
