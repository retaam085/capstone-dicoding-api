<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(){
        dd('hai');
    }

    public function update(){

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

    public function showById(){
        $news = News::findOrFails(request('id'));
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

    public function delete(){
        $news = News::findOrFails(request('id'));
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
