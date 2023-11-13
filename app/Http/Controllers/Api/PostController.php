<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;


class PostController extends Controller
{

    public function index(){
        return view('index');
    }


    public function store(CreatePostRequest $request){

      try{
          // dd($request);
          $post = new Post();
          $post->title = $request->title;
          $post->description = $request->description;
          $post->save();

        return response()->json([
              "status_code" => "200",
              "status_message" => "le post a ete ajoute",
              "data"=>$post
          ]);
      }
      catch(Exception $e){
           return response()->json($e);
      }

    }


    public function update(UpdatePostRequest $request,Post $id){


        $id->title = $request->title;
        $id->description = $request->description;
        $id->save();

    }





}
