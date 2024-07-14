<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Users;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Helpers\Gambar;
use App\Models\LaporanSehat;
use App\Models\LaporanPintar;
use App\Models\LaporanHijau;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller {

    public function __construct() {
        $this->view =  'dashboard.laporan';
        $this->modelSehat = new LaporanSehat();
        $this->modelPintar = new LaporanPintar();
        $this->modelHijau = new LaporanHijau();
    }

    public function add(Request $request){

        if($request->method()=="GET"):
            $jenisPillar = Auth::user()->category_id;

            if ($jenisPillar == 1) {
                if (auth()->user()->role_id < 2) {
                    $currentYear = date('Y');
                    $data['availableYears'] = range($currentYear - 5, $currentYear);
                    $data['selectedYear'] = $request->input('year', date('Y'));
                    $data['laporans'] = $this->modelSehat->where('user_id',Auth::user()->id)
                        ->whereYear('tahun','=',$request->year ?? $currentYear)
                        ->orderByRaw("FIELD(periode, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
                        ->get();
                }else {
                    $currentYear = date('Y');
                    $data['availableYears'] = range($currentYear - 5, $currentYear);
                    $data['selectedYear'] = $request->input('year', date('Y'));
                    $data['users'] = Users::where('category_id','=',1)
                        ->where('role_id','=',1)
                        ->get();
                    $data['laporans'] = LaporanSehat::with('user')
                        ->whereYear('tahun','=',$request->year ?? $currentYear)
                        ->orderByRaw("FIELD(periode, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
                        ->get();
                }
                return view($this->view.'.laporan-sehat', $data);
            }elseif ($jenisPillar == 2) {
                if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor' ) {
                    $data['laporans'] = $this->modelPintar->all();
                }else {
                    $data['laporans'] = $this->modelPintar->where('user_id',Auth::user()->id)->get();
                }
                return view($this->view.'.laporan-pintar', $data);
            }else{
                if (auth()->user()->role_id < 2) {
                    $data['laporans'] = $this->modelHijau->where('user_id',Auth::user()->id)
                        ->orderByRaw("FIELD(periode, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
                        ->get();
                }else {
                    $data['users'] = Users::where('role_id','=',1)->get();
                    $data['laporans'] = LaporanHijau::with('user')
                        ->orderByRaw("FIELD(periode, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')")
                        ->get();
                }
                return view($this->view.'.laporan-hijau', $data);
            }


        else:
            $jenisPillar = Auth::user()->category_id;

            if ($jenisPillar == 1) {
                $laporan = LaporanSehat::where('user_id','=',auth()->user()->id)
                            ->where('periode','=',$request->periode)
                            ->whereYear('tahun','=', $request->tahun)->get();
                if ($laporan->isNotEmpty()){
                    $createData = 'Periode '. $request->periode. ' Sudah Ada.';
                }else{
                    $createData = LaporanSehat::create($request);
                }
            }elseif ($jenisPillar == 2) {
                $createData = LaporanPintar::create($request);
            }elseif($jenisPillar == 3){
                $laporan = LaporanHijau::where('user_id','=',auth()->user()->id)
                            ->where('periode','=',$request->periode)
                            ->whereYear('created_at', date('Y'))->get();
                if ($request->pic != null){
                    $data = array(
                        'periode' => $request->periode,
                        'konservasi_penyu' => $request->konversi,
                        'jml_telur_ditemukan' => $request->jml_telur_ditemukan,
                        'jml_telur_menetas'	 => $request->jml_telur_menetas,
                        'jml_tukik_dilepas'	 => $request->jml_tukik_dilepas,
                        'jml_pengunjung'	 => $request->jml_pengunjung,
                        'jenis_penyu'		 => $request->jenis_penyu,
                        'inovasi_program'	 => $request->inovasi_program,
                        'user_id'	 => $request->pic
                    );
                }else{
                    $data = array(
                        'periode' => $request->periode,
                        'konservasi_penyu' => $request->konversi,
                        'jml_telur_ditemukan' => $request->jml_telur_ditemukan,
                        'jml_telur_menetas'	 => $request->jml_telur_menetas,
                        'jml_tukik_dilepas'	 => $request->jml_tukik_dilepas,
                        'jml_pengunjung'	 => $request->jml_pengunjung,
                        'jenis_penyu'		 => $request->jenis_penyu,
                        'inovasi_program'	 => $request->inovasi_program,
                        'user_id'	 => auth()->user()->id
                    );
                }

                if ($laporan->isNotEmpty()){
                    $createData = 'Periode '. $request->periode. ' Sudah Ada.';
                }else{
                    $createData = LaporanHijau::insert($data);
                }
            }
            if($createData == 'success'){
                return redirect()->route('add-laporan')->with(['success' => 'Data Berhasil ditambahkan']);

            }else{
                return redirect()->route('add-laporan')->with(['failed' => 'Data Gagal Ditambahkan ' . $createData]);
            }
        endif;
    }

    public function edit(Request $request){

        if (auth()->user()->category_id == 1){
            $sehat = LaporanSehat::find($request->id);
            $sehat->posyandu = $request->posyandu;
            $sehat->area = $request->area;
            $sehat->periode = $request->periode;
            $sehat->jml_kader = $request->jml_kader;
            $sehat->jml_balita = $request->jml_balita;
            $sehat->jml_ibu_hamil = $request->jml_ibu_hamil;
            $sehat->jenis_vaksin = $request->jenis_vaksin;
            $sehat->jml_vaksin = $request->jml_vaksin;
            $sehat->inovasi_program = $request->inovasi_program;
            $sehat->save();

        }elseif (auth()->user()->category_id == 3){
            $hijau = LaporanHijau::find($request->id);
            $hijau->konservasi_penyu = $request->konversi_penyu;
            $hijau->periode = $request->periode;
            $hijau->jml_telur_ditemukan = $request->jml_telur_ditemukan;
            $hijau->jml_telur_menetas = $request->jml_telur_menetas;
            $hijau->jml_tukik_dilepas = $request->jml_tukik_dilepas;
            $hijau->jml_pengunjung = $request->jml_pengunjung;
            $hijau->jenis_penyu = $request->jenis_penyu;
            $hijau->inovasi_program = $request->inovasi_program;
            $hijau->save();
        }
        if ($hijau == true || $sehat == true){
            return redirect()->route('add-laporan')->with(['success' => 'Data Berhasil Diubah']);
        }else{
            return redirect()->route('add-laporan')->with(['failed' => 'Data Gagal diubah']);
        }
    }

    public function delete($id){

        $jenisPillar = Auth::user()->category_id;

        if ($jenisPillar == 1) {
            $data = LaporanSehat::find($id);
        }elseif ($jenisPillar == 2) {
            $data = LaporanPintar::find($id);
        }else{
            $data = LaporanHijau::find($id);
        }

        $deleteData = $data->delete();
        if($deleteData == true){
            return redirect()->route('add-laporan')->with(['success' => 'Data Berhasil dihapus']);
        }else{
            return redirect()->route('add-laporan')->with(['failed' => 'Data Tidak Berhasil dihapus']);
        }
    }





}
