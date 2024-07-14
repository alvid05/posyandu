<?php

namespace App\Models;
use DB;
use Auth;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model {
    protected $table = 'audit';

    
    static function create($request){
        try{
            $add = new Audit;
            $add->periode = $request->periode;
            $add->jml_kader = $request->jml_kader;
            $add->jml_balita = $request->jml_balita;
            $add->jml_ibu_hamil = $request->jml_ibu_hamil;
            $add->jenis_vaksin = $request->jenis_vaksin;
            $add->jml_vaksin = $request->jml_vaksin;
            $add->inovasi_program = $request->inovasi_program;
            $add->user_id = Auth::user()->id;
            $add->save();
            return 'success';
         }
         catch(\Exception $e){
           return $e;
         }
    }

    static function edit($id, $request){
        try{

            $edit = Audit::find($id);
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