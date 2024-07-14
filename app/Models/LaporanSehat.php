<?php

namespace App\Models;
use DB;
use Auth;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class LaporanSehat extends Model {
    protected $table = 'laporan_sehat';

    public function user()
    {
        return $this->belongsTo(Users::class,'user_id','id');
    }

    static function create($request){
        try{
            $add = new LaporanSehat;
            $add->posyandu = ucwords(strtolower($request->posyandu));
            $add->area = $request->area;
            $add->periode = $request->periode;
            $add->jml_kader = $request->jml_kader;
            $add->jml_balita = $request->jml_balita;
            $add->jml_ibu_hamil = $request->jml_ibu_hamil;
            $add->jenis_vaksin = $request->jenis_vaksin;
            $add->jml_vaksin = $request->jml_vaksin;
            $add->inovasi_program = ucwords(strtolower($request->inovasi_program));
            if ($request->pic != null){
                $add->user_id = $request->pic;
            }else{
                $add->user_id = Auth::user()->id;
            }
            $add->tahun = $request->tahun;
            $add->save();
            return 'success';
         }
         catch(\Exception $e){
           return $e;
         }
    }

    static function edit($id, $request){
        try{

            $edit = LaporanSehat::find($id);
            $edit->periode = $request->periode;
            $edit->jml_kader = $request->jml_kader;
            $edit->jml_balita = $request->jml_balita;
            $edit->jml_ibu_hamil = $request->jml_ibu_hamil;
            $edit->jenis_vaksin = $request->jenis_vaksin;
            $edit->jml_vaksin = $request->jml_vaksin;
            $edit->inovasi_program = $request->inovasi_program;
            $edit->user_id = Auth::user()->id;
            $edit->save();
            return 'success';
        }
        catch(\Exception $e){
           return $e;
        }
    }
}
?>
