<?php

namespace App\Http\Controllers\Dashboard\Blog;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Blog\Tag;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class TagController extends Controller {

    public function __construct() {
        $this->view =  'dashboard.blog.tag';
    }

    public function view(){
        $models = Tag::orderBy('created_at','DESC')->get();
        $args = ['models' => $models];
        return view($this->view.'.index', $args);
    }

    public function create(){
        return view($this->view.'.form');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:tags,name',
        ]);
        $createData = Tag::create($request);
        if($createData == true){
            return redirect()->route('view-blog-tag')->with(['success' => 'Data Berhasil ditambahkan']);
        }else{
            return redirect()->route('view-blog-tag')->with(['failed' => 'Data Tidak Gagal ditambahkan']);
        }
    }

    public function edit($id){

        $dataEdit = Tag::find($id);
        $args = ['dataEdit'=>$dataEdit];
        return view($this->view.'.form', $args);

    }

    public function update($id, Request $request){
        $request->validate([
            'name' => [
                'required',
                Rule::unique('tags', 'name')->ignore($id),
            ]
        ]);

        $updateData = Tag::edit($id, $request);
        if($updateData == true){
            return redirect()->route('view-blog-tag')->with(['success' => 'Data Berhasil diupdate']);
        }else{
            return redirect()->route('view-blog-tag')->with(['failed' => 'Data Gagal diupdate']);
        }
    }

    public function delete($id){
        $data = Tag::find($id);
        $deleteData = $data->delete();
        if($deleteData == true){
            return redirect()->route('view-blog-tag')->with(['success' => 'Data Berhasil dihapus']);
        }else{
            return redirect()->route('view-blog-tag')->with(['failed' => 'Data Gagal dihapus']);
        }
    }





}