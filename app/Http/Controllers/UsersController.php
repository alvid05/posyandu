<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Dashboard\AuditController;
use App\Models\CategoryPillar;
use App\Models\HasilAss;
use App\Models\LaporanHijau;
use App\Models\LaporanSehat;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Helpers\Gambar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller {

    public function __construct() {
        $this->view =  'dashboard';
    }

    public function login(){
        return view($this->view.'.login');
    }

    public function register(){
        $data['kategori'] = CategoryPillar::all();
        $data['audit'] = Users::where('role_id', '=', 2)->get();
        return view($this->view.'.register',$data);
    }

    public function getAuditorsByCategory(Request $request)
    {
        $category_id = $request->input('category_id');
        $auditors = Users::where('role_id', 2)
            ->where('category_id', $category_id)
            ->get();

        return response()->json($auditors);
    }

    public function registering(Request $request){
        $request->validate([
            'email' => 'required|email|unique:users,email|max:30',
            'username' => 'required|unique:users,name|max:30',
            'password' => 'required|required_with:confirm_password|same:confirm_password|min:8|max:15',
        ]);
        $data = array(
            'email' => $request->email,
            'name' => ucwords(strtolower($request->username)),
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'category_id' => $request->jenis_pilar,
            'group_name' => ucwords(strtolower($request->nama_kelompok) ?? null),
            'wilayah' => ucwords(strtolower($request->wilayah)),
            'role_id' => 1
        );
        $createData = Users::insert($data);
        if($createData == true){
            return redirect()->route('login')->with(['success' => 'Berhasil melakukan register akun, silahkan masukan kembali credential anda']);
        }else{
            return redirect()->route('login')->with(['failed' => 'Gagal melakukan register akun']);
        }

    }

    public function logining(Request $request){
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|min:8|max:15',
        ]);

        $cred = [
            'email' => $request['email'],
            'password' => $request['password']
        ];

        if (Auth::attempt($cred) && auth()->user()->is_active == 'Active'){
            if (auth()->user()->role_id != 2){
                return redirect()->route('view-dashboard');
            }else{
                return redirect()->route('view-audit');
            }
        }else if(Auth::attempt($cred) && auth()->user()->is_active == 'Inactive'){
            return redirect()->route('login')->with(['failed' => 'Gagal melakukan Sign In, akun anda tidak aktif']);
        }else{
            return redirect()->route('login')->with(['failed' => 'Gagal melakukan Sign In silahkan cek email dan password kembali']);
        }
    }

    public function dashboard(Request $request)
    {
        $current = date('Y');
        if (Auth::check()) {
            $current = date('Y');
            $user = HasilAss::with('schedule.user')->whereYear('created_at', $request->year ?? $current)->get();
            if (auth()->user()->role_id > 1){
            //  Diagram Laporan Sehat
                $chartData = LaporanSehat::select('periode', 'jml_kader', 'jml_balita', 'jml_ibu_hamil', 'jml_vaksin')
                    ->whereYear('tahun', $request->year ?? $current)
                    ->get()
                    ->groupBy('periode')
                    ->map(function ($group) {
                        return [
                            'jml_kader' => $group->sum('jml_kader'),
                            'jml_balita' => $group->sum('jml_balita'),
                            'jml_ibu_hamil' => $group->sum('jml_ibu_hamil'),
                            'jml_vaksin' => $group->sum('jml_vaksin'),
                        ];
                    });

                // Separate data for each chart
                $chartDataBalita = $chartData->pluck('jml_balita');
                $chartDataKader = $chartData->pluck('jml_kader');
                $chartDataIbuHamil = $chartData->pluck('jml_ibu_hamil');
                $chartDataVaksin = $chartData->pluck('jml_vaksin');

                // Calculate total for each category
                $totalBalita = $chartDataBalita->sum();
                $totalKader = $chartDataKader->sum();
                $totalIbuHamil = $chartDataIbuHamil->sum();
                $totalVaksin = $chartDataVaksin->sum();

                $chartDataHijau = LaporanHijau::select('periode', 'jml_telur_ditemukan', 'jml_telur_menetas', 'jml_tukik_dilepas', 'jml_pengunjung')
                    ->whereYear('created_at', $request->year ?? $current)
                    ->get()
                    ->groupBy('periode')
                    ->map(function ($group) {
                        return [
                            'jml_telur_ditemukan' => $group->sum('jml_telur_ditemukan'),
                            'jml_telur_menetas' => $group->sum('jml_telur_menetas'),
                            'jml_tukik_dilepas' => $group->sum('jml_tukik_dilepas'),
                            'jml_pengunjung' => $group->sum('jml_pengunjung'),
                        ];
                    });

                $chartDataTelurDitemukan = $chartDataHijau->pluck('jml_telur_ditemukan');
                $chartDataTelurMenetas = $chartDataHijau->pluck('jml_telur_menetas');
                $chartDataTukikDilepas = $chartDataHijau->pluck('jml_tukik_dilepas');
                $chartDataPengunjung = $chartDataHijau->pluck('jml_pengunjung');

                $totalTelurDitemukan = $chartDataTelurDitemukan->sum();
                $totalTelurMenetas = $chartDataTelurMenetas->sum();
                $totalTukikDilepas = $chartDataTukikDilepas->sum();
                $totalPengunjung = $chartDataPengunjung->sum();
            }else{
                $chartData = LaporanSehat::select('periode', 'jml_kader', 'jml_balita', 'jml_ibu_hamil', 'jml_vaksin')
                    ->where('user_id','=',auth()->user()->id)
                    ->whereYear('tahun', $request->year ?? $current)
                    ->get()
                    ->groupBy('periode')
                    ->map(function ($group) {
                        return [
                            'jml_kader' => $group->sum('jml_kader'),
                            'jml_balita' => $group->sum('jml_balita'),
                            'jml_ibu_hamil' => $group->sum('jml_ibu_hamil'),
                            'jml_vaksin' => $group->sum('jml_vaksin'),
                        ];
                    });

                $chartData2 = LaporanSehat::select('periode', 'jml_kader', 'jml_balita', 'jml_ibu_hamil', 'jml_vaksin')
                    ->whereYear('tahun', $request->year ?? $current)
                    ->get()
                    ->groupBy('periode')
                    ->map(function ($group) {
                        return [
                            'jml_kader' => $group->sum('jml_kader'),
                            'jml_balita' => $group->sum('jml_balita'),
                            'jml_ibu_hamil' => $group->sum('jml_ibu_hamil'),
                            'jml_vaksin' => $group->sum('jml_vaksin'),
                        ];
                    });

                // Separate data for each chart
                $chartDataBalita = $chartData->pluck('jml_balita');
                $chartDataKader = $chartData->pluck('jml_kader');
                $chartDataIbuHamil = $chartData->pluck('jml_ibu_hamil');
                $chartDataVaksin = $chartData->pluck('jml_vaksin');

                // Calculate total for each category
                $totalBalita = $chartData2->pluck('jml_balita')->sum();
                $totalKader =  $chartData2->pluck('jml_kader')->sum();
                $totalIbuHamil = $chartData2->pluck('jml_ibu_hamil')->sum();
                $totalVaksin = $chartData2->pluck('jml_vaksin')->sum();

                $chartDataHijau = LaporanHijau::select('periode', 'jml_telur_ditemukan', 'jml_telur_menetas', 'jml_tukik_dilepas', 'jml_pengunjung')
                    ->where('user_id','=',auth()->user()->id)
                    ->whereYear('created_at', $request->year ?? $current)
                    ->get()
                    ->groupBy('periode')
                    ->map(function ($group) {
                        return [
                            'jml_telur_ditemukan' => $group->sum('jml_telur_ditemukan'),
                            'jml_telur_menetas' => $group->sum('jml_telur_menetas'),
                            'jml_tukik_dilepas' => $group->sum('jml_tukik_dilepas'),
                            'jml_pengunjung' => $group->sum('jml_pengunjung'),
                        ];
                    });

                $chartDataHijau2 = LaporanHijau::select('periode', 'jml_telur_ditemukan', 'jml_telur_menetas', 'jml_tukik_dilepas', 'jml_pengunjung')
                    ->whereYear('created_at', $request->year ?? $current)
                    ->get()
                    ->groupBy('periode')
                    ->map(function ($group) {
                        return [
                            'jml_telur_ditemukan' => $group->sum('jml_telur_ditemukan'),
                            'jml_telur_menetas' => $group->sum('jml_telur_menetas'),
                            'jml_tukik_dilepas' => $group->sum('jml_tukik_dilepas'),
                            'jml_pengunjung' => $group->sum('jml_pengunjung'),
                        ];
                    });

                $chartDataTelurDitemukan = $chartDataHijau->pluck('jml_telur_ditemukan');
                $chartDataTelurMenetas = $chartDataHijau->pluck('jml_telur_menetas');
                $chartDataTukikDilepas = $chartDataHijau->pluck('jml_tukik_dilepas');
                $chartDataPengunjung = $chartDataHijau->pluck('jml_pengunjung');

                $totalTelurDitemukan = $chartDataHijau2->pluck('jml_telur_ditemukan')->sum();
                $totalTelurMenetas = $chartDataHijau2->pluck('jml_telur_menetas')->sum();
                $totalTukikDilepas = $chartDataHijau2->pluck('jml_tukik_dilepas')->sum();
                $totalPengunjung = $chartDataHijau2->pluck('jml_pengunjung')->sum();
            }
            $availableYears = range($current - 2, $current);
            $selectedYear = $request->input('year', date('Y'));
            return view($this->view . '.dashboard', compact('chartDataBalita',
                'chartDataKader', 'chartDataIbuHamil', 'chartDataVaksin',
                'totalBalita', 'totalKader', 'totalIbuHamil', 'totalVaksin','user','totalTelurDitemukan',
            'totalTelurMenetas','totalTukikDilepas','totalPengunjung','chartDataTelurDitemukan','chartDataTelurMenetas',
            'chartDataTukikDilepas','chartDataPengunjung','availableYears','selectedYear'));
        } else {
            return redirect()->route('login');
        }
    }


    public function home(){

        return view('home');

    }

    public function profile(Request $request){

        if($request->method()=="GET"):
            $roles = Roles::orderBy('role','ASC')->get();
            $option_role = [];
            foreach($roles as $role){
                $option_role[$role->id] = $role->role;
            }
            $user = Users::with('categoryPillar')->where('id','=',auth()->user()->id);
            $img = Gambar::encodeFromMedia(Users::$media, Auth::user()->avatar);
            $args = ['option_role' => $option_role,'img'=>$img,'user' => $user];
            return view('dashboard.profile',$args);
        else:
            $id = Auth::user()->id;
            $updateData = Users::profile($id, $request);
            if($updateData == true){
                return redirect()->route('view-profile')->with(['success' => 'Data Berhasil diupdate']);

            }else{
                return redirect()->route('view-profile')->with(['failed' => 'Data Gagal diupdate']);
            }
        endif;

    }

    public function logingout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function logingoutUser(){
        Auth::logout();
        return redirect()->route('home');
    }




}
