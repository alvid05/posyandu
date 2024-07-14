<?php

namespace App\Http\Controllers\Dashboard;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Helpers\Gambar;
use App\Models\Roles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RolesController extends Controller {

    public function __construct() {
        $this->view =  'dashboard.ums';
    }

    public function view(){
        $role = Roles::orderBy('created_at','DESC')->get();

        $args = ['role' => $role];
        return view($this->view.'.role', $args);
    }

    public function create(){
        $args = [];
        return view($this->view.'.role-form', $args);
    }

    public function store(Request $request){
        $createData = Roles::create($request);
        if($createData == true){
            return redirect()->route('view-ums-role')->with(['success' => 'Data '. $request->title .' Berhasil ditambahkan']);
        }else{
            return redirect()->route('view-ums-role')->with(['failed' => 'Data '. $request->title .' Tidak Berhasil ditambahkan']);
        }
    }

    public function edit($id){
        $role = Roles::find($id);
        $args = ['role'=>$role];
        return view($this->view.'.role-form', $args);
        
    }

    public function update($id, Request $request){
        $updateData = Roles::edit($id, $request);
        if($updateData == true){
            return redirect()->route('view-ums-role')->with(['success' => 'Data '. $request->title .' Berhasil diupdate']);
        }else{
            return redirect()->route('view-ums-role')->with(['failed' => 'Data '. $request->title .' Tidak Berhasil diupdate']);
        }
    }

    public function delete($id){
        $role = Roles::find($id);
        $deleteData = $role->delete();
        if($deleteData == true){
            return redirect()->route('view-ums-role')->with(['success' => 'Data Berhasil dihapus']);
        }else{
            return redirect()->route('view-ums-role')->with(['failed' => 'Data Tidak Berhasil dihapus']);
        }
    }

   


    
}