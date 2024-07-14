<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\CategoryPillar;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Helpers\Gambar;
use App\Models\Users;
use App\Models\Roles;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller {

    public function __construct() {
        $this->view =  'dashboard.ums';
    }

    public function view(){
        $users = Users::with('roles')->orderBy('created_at','DESC')->get();
        $role = Roles::orderBy('role','ASC')->get();

        $args = ['users' => $users,'role' => $role];
        return view($this->view.'.users', $args);
    }

    public function create(){
        $roles = Roles::orderBy('role','ASC')->get();
        $kategori = CategoryPillar::all();
        $option_role = [];
        foreach($roles as $role){
            $option_role[$role->id] = $role->role;
        }

        $args = ['option_role' => $option_role,'kategori' => $kategori];
        return view($this->view.'.users-form', $args);
    }

    public function getAuditorsByCategory(Request $request)
    {
        $category_id = $request->input('category_id');
        $auditors = Users::where('role_id', 2)
            ->where('category_id', $category_id)
            ->get();

        return response()->json($auditors);
    }

    public function store(Request $request){
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = "profil".uniqid().'.'.$file->getClientOriginalExtension();
            $file->move('assets/img/users', $filename);
        }
        $data = array(
            'name' => $request->username,
            'email' => $request->email,
            'password' => password_hash($request->password,PASSWORD_DEFAULT),
            'group_name' => $request->nama_kelompok ?? null,
            'category_id' => $request->jenis_pilar ?? null,
            'role_id' => $request->role_id,
            'wilayah' => $request->wilayah ?? null,
            'avatar' => $filename ?? null,
            'is_active' => $request->is_active,
        );
        $createData = Users::insert($data);
        if($createData == true){
            return redirect()->route('view-ums-users')->with(['success' => 'Data Berhasil ditambahkan']);
        }else{
            return redirect()->route('view-ums-users')->with(['failed' => 'Data  Tidak Berhasil ditambahkan']);
        }
    }

    public function edit($id){
        $users = Users::find($id);
        $audit = Users::where('role_id','=',2)->get();
        $roles = Roles::orderBy('role','ASC')->get();
        $kategori = CategoryPillar::all();
        $option_role = [];
        foreach($roles as $role){
            $option_role[$role->id] = $role->role;
        }
        $img = Gambar::encodeFromMedia(Users::$media, $users->avatar);
        $args = ['users' => $users,'option_role' => $option_role,'img'=>$img,'kategori'=>$kategori,'audit'=>$audit];
        return view($this->view.'.users-form', $args);

    }

    public function update($id, Request $request){
        $user = Users::find($id);
        // Periksa apakah file telah diunggah
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $file->move('assets/img/users', $filename);
            $user->avatar = $filename;
        }
        $user->name = $request->username;
        $user->email = $request->email;
        if (!empty($request->password)){
            $user->password = password_hash($request->password,PASSWORD_DEFAULT);
        }
        if (!empty($request->password)){
            $user->password = password_hash($request->password,PASSWORD_DEFAULT);
        }
        if (!empty($request->phone_number)){
            $user->phone_number = $request->phone_number;
        }
        if (!empty($request->auditor)){
            $user->audit_id = $request->auditor;
        }
        if (!empty($request->nama_kelompok)){
            $user->group_name = $request->nama_kelompok;
        }if (!empty($request->jenis_pilar)){
            $user->category_id = $request->jenis_pilar;
        }if (!empty($request->role_id)){
            $user->role_id = $request->role_id;
        }if (!empty($request->wilayah)){
            $user->wilayah = $request->wilayah;
        }if (!empty($request->is_active)){
            $user->is_active = $request->is_active;
        }
        $updateData = $user->save();

        if($updateData == true){
            if ($request->role_id != null && auth()->user()->role_id != null){
                return redirect()->route('view-ums-users')->with(['success' => 'Data Berhasil diupdate']);
            }else{
                return redirect()->route('view-setting-dashboard')->with(['success' => 'Data Berhasil diupdate']);
            }
        }else{
            if ($request->role_id != null && auth()->user()->role_id != null){
                return redirect()->route('view-ums-users')->with(['failed' => 'Data Tidak Berhasil diupdate']);
            }else{
                return redirect()->route('view-setting-dashboard')->with(['failed' => 'Data Tidak Berhasil diupdate']);
            }
        }
    }

    public function delete($id){
        $users = Users::find($id);
        $deleteData = $users->delete();
        if($deleteData == true){
            return redirect()->route('view-ums-users')->with(['success' => 'Data Berhasil dihapus']);
        }else{
            return redirect()->route('view-ums-users')->with(['failed' => 'Data Tidak Berhasil dihapus']);
        }
    }

    public function setting(){
        $img = Gambar::encodeFromMedia(Users::$media, auth()->user()->avatar);
        $args = ['img'=>$img];
        return view('dashboard.settings', $args);
    }





}
