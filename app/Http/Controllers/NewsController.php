<?php

namespace App\Http\Controllers;

use App\Models\News;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class NewsController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function create(){

        $validate = FacadesValidator::make(request()->all(),[
            'judul' => 'required',
            'isi'=> 'required',
        ]);

        if($validate->fails()){
            return response()->json($validate->messages());
        }


        $news = News::create([
            'judul' => request('judul'),
            'isi' => request('isi')
        ]);
        if($news){
            return response()->json([
                'data' => $news,
                'code' => 201,
                'message' => 'data berhasil ditambah'
            ]);
        }else{
            return response()->json([
                'code' => 401,
                'message' => 'data tidak berhasil ditambah'
            ]);
        }
    }

    public function update($id){

        $validate = FacadesValidator::make(request()->all(),[
            'judul' => 'required',
            'isi'=> 'required',
        ]);

        $news = News::findOrFail($id);
        $news->update([
            'judul' => request('judul'),
            'isi' => request('isi')
        ]);

        if($news){
            return response()->json([
                'data' => $news,
                'code' => 200,
                'message' => 'data berhasil diupdate'
            ]);
        }else{
            return response()->json([
                'code' => 401,
                'message' => 'data tidak berhasil diupdate'
            ]);
        }
    }

    public function showAll(){
        $news = News::get();
        if($news){
            return response()->json([
                'data' => $news,
                'code' => 200,
                'message' => 'data berhasil didapat'
            ]);
        }else{
            return response()->json([
                'code' => 401,
                'message' => 'data tidak berhasil didapat'
            ]);
        }
    }

    public function showById($id){
        $news = News::findOrFail($id);
        if($news){
            return response()->json([
                'data' => $news,
                'code' => 200,
                'message' => 'data berhasil didapat'
            ]);
        }else{
            return response()->json([
                'code' => 401,
                'message' => 'data tidak berhasil didapat'
            ]);
        }
    }

    public function delete($id){
        $news = News::findOrFail($id);
        $news->delete();
        if($news){
            return response()->json([
                'code' => 200,
                'message' => 'data berhasil dihapus'
            ]);
        }else{
            return response()->json([
                'code' => 401,
                'message' => 'data tidak berhasil dihapus'
            ]);
        }
    }

}
