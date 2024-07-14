<?php

namespace App\Http\Controllers\Dashboard\Blog;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Helpers\Gambar;
use App\Models\Blog\Post;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PostController extends Controller {

    public function __construct() {
        $this->view =  'dashboard.blog.post';
    }

    public function view(){
        $models = Post::with('user','category')->orderBy('created_at','DESC')->get();
        $args = ['models' => $models];
        return view($this->view.'.index', $args);
    }

    public function create(){
        return view($this->view.'.form');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|unique:posts,title',
        ]);
        $createData = Post::create($request);
        if($createData == true){
            return redirect()->route('view-blog-post')->with(['success' => 'Data Berhasil ditambahkan']);
        }else{
            return redirect()->route('view-blog-post')->with(['failed' => 'Data Tidak Gagal ditambahkan']);
        }
    }

    public function edit($id){

        $dataEdit = Post::find($id);
        $thumbnail = Gambar::encodeFromMedia(Post::$media, $dataEdit->image);
        $args = ['dataEdit'=>$dataEdit, 'thumbnail' => $thumbnail];
        return view($this->view.'.form', $args);

    }

    public function update($id, Request $request){
        $request->validate([
            'title' => [
                'required',
                Rule::unique('posts', 'title')->ignore($id),
            ]
        ]);

        $updateData = Post::edit($id, $request);
        if($updateData == true){
            return redirect()->route('view-blog-post')->with(['success' => 'Data Berhasil diupdate']);
        }else{
            return redirect()->route('view-blog-post')->with(['failed' => 'Data Gagal diupdate']);
        }
    }

    public function delete($id){
        $data = Post::find($id);
        $url = public_path().'/assets/img/post'.$data->image;
        if ((file_exists( $url ))) {
            unlink($url);
        }
        $deleteData = $data->delete();
        if($deleteData == true){
            return redirect()->route('view-blog-post')->with(['success' => 'Data Berhasil dihapus']);
        }else{
            return redirect()->route('view-blog-post')->with(['failed' => 'Data Gagal dihapus']);
        }
    }





}