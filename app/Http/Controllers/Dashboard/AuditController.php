<?php

namespace App\Http\Controllers\Dashboard;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Helpers\Gambar;
use App\Models\Audit;
use App\Models\LaporanSehat;
use App\Models\LaporanPintar;
use App\Models\LaporanHijau;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AuditController extends Controller {

    public function __construct() {
        $this->modelSehat = new LaporanSehat();
        $this->modelPintar = new LaporanPintar();
        $this->modelHijau = new LaporanHijau();
    }

    public function index(){

        $data['laporanSehat'] = $this->modelSehat->orderBy('created_at','DESC')->get();
        $data['laporanPintar'] = $this->modelPintar->orderBy('created_at','DESC')->get();
        $data['laporanHijau'] = $this->modelHijau->orderBy('created_at','DESC')->get();

        return view('dashboard.audit.view', $data);
    }

    public function add(Request $request){

        if($request->method()=="GET"):
            $jenisPillar = Auth::user()->jenis_pillar;

            if ($jenisPillar == 'Sehat Bersama Daihatsu') {
                if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor' ) {
                    $data['laporans'] = $this->modelSehat->get();
                }else {
                    $data['laporans'] = $this->modelSehat->where('user_id',Auth::user()->id)->get();
                }
                return view($this->view.'.laporan-sehat', $data);
            }elseif ($jenisPillar == 'Pintar Bersama Daihatsu') {
                if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor' ) {
                    $data['laporans'] = $this->modelPintar->get();
                }else {
                    $data['laporans'] = $this->modelPintar->where('user_id',Auth::user()->id)->get();
                }
                return view($this->view.'.laporan-pintar', $data);
            }else{
                if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor' ) {
                    $data['laporans'] = $this->modelHijau->get();
                }else {
                    $data['laporans'] = $this->modelHijau->where('user_id',Auth::user()->id)->get();
                }
                return view($this->view.'.laporan-hijau', $data);
            }


        else:
            $jenisPillar = Auth::user()->jenis_pillar;

            if ($jenisPillar == 'Sehat Bersama Daihatsu') {
                $createData = LaporanSehat::create($request);
            }elseif ($jenisPillar == 'Pintar Bersama Daihatsu') {
                $createData = LaporanPintar::create($request);
            }else{
                $createData = LaporanHijau::create($request);
            }


            if($createData == 'success'){
                return redirect()->route('add-laporan')->with(['success' => 'Data Berhasil ditambahkan']);

            }else{
                return redirect()->route('add-laporan')->with(['failed' => 'Data Gagal ditambahkan' . $createData]);
            }
        endif;
    }

    public function edit(Request $request, $id){
        if($request->method()=="GET"):
            $jenisPillar = Auth::user()->jenis_pillar;

            if ($jenisPillar == 'Sehat Bersama Daihatsu') {
                if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor' ) {
                    $data['laporan'] = $this->modelSehat->find($id);
                }
                return view('dashboard.laporan.laporan-sehat-edit', $data);
            }elseif ($jenisPillar == 'Pintar Bersama Daihatsu') {
                if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor' ) {
                    $data['laporan'] = $this->modelPintar->find($id);
                }
                return view('dashboard.laporan.laporan-pintar-edit', $data);
            }else{
                if (Auth::user()->roles->role == 'administrator' || Auth::user()->roles->role == 'asesor' ) {
                    $data['laporan'] = $this->modelHijau->find($id);
                }
                return view('dashboard.laporan.laporan-hijau-edit', $data);
            }


        else:
            $jenisPillar = Auth::user()->jenis_pillar;

            if ($jenisPillar == 'Sehat Bersama Daihatsu') {
                $editData = LaporanSehat::edit($id, $request);
            }elseif ($jenisPillar == 'Pintar Bersama Daihatsu') {
                $editData = LaporanPintar::edit($id, $request);
            }else{
                $editData = LaporanHijau::edit($id, $request);
            }


            if($editData == 'success'){
                return redirect()->route('add-laporan')->with(['success' => 'Data Berhasil diupdate']);

            }else{
                return redirect()->route('add-laporan')->with(['failed' => 'Data Gagal diupdate' . $editData]);
            }
        endif;

    }

    public function delete($id){

        $jenisPillar = Auth::user()->jenis_pillar;

        if ($jenisPillar == 'Sehat Bersama Daihatsu') {
            $data = LaporanSehat::find($id);
        }elseif ($jenisPillar == 'Pintar Bersama Daihatsu') {
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
