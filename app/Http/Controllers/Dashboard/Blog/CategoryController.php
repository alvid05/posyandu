<?php

namespace App\Http\Controllers\Dashboard\Blog;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Helpers\Gambar;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Blog\Category;
use App\Models\PaketInternet;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Helpers\Money;

class CategoryController extends Controller {

    public function __construct() {
        $this->view =  'dashboard.blog.category';
    }

    public function view(){
        $models = Category::with('user')->orderBy('created_at','DESC')->get();
        $args = ['models' => $models];
        return view($this->view.'.index', $args);
    }

    public function create(){
        return view($this->view.'.form');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        $createData = Category::create($request);
        if($createData == true){
            return redirect()->route('view-blog-category')->with(['success' => 'Data Berhasil ditambahkan']);
        }else{
            return redirect()->route('view-blog-category')->with(['failed' => 'Data Tidak Gagal ditambahkan']);
        }
    }

    public function edit($id){

        $dataEdit = Category::find($id);
        $img = Gambar::encodeFromMedia(Category::$media, $dataEdit->image);
        $args = ['dataEdit'=>$dataEdit, 'img' => $img];
        return view($this->view.'.form', $args);

    }

    public function update($id, Request $request){
        $request->validate([
            'name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($id),
            ]
        ]);

        $updateData = Category::edit($id, $request);
        if($updateData == true){
            return redirect()->route('view-blog-category')->with(['success' => 'Data Berhasil diupdate']);
        }else{
            return redirect()->route('view-blog-category')->with(['failed' => 'Data Gagal diupdate']);
        }
    }

    public function delete($id){
        $data = Category::find($id);
        $url = public_path().'/assets/img/category'.$data->image;
        if ((file_exists( $url ))) {
            unlink($url);
        }
        $deleteData = $data->delete();
        if($deleteData == true){
            return redirect()->route('view-blog-category')->with(['success' => 'Data Berhasil dihapus']);
        }else{
            return redirect()->route('view-blog-category')->with(['failed' => 'Data Gagal dihapus']);
        }
    }





}