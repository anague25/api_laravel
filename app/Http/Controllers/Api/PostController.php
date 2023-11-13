<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;


class PostController extends Controller
{

    public function index(Request $request){

        try{

        $query = Post::query();
        $perpage = 2;
        $page = $request->input("page",1);
        $search = $request->input("search");
        if($search){
            $query->whereRaw("title LIKE '%".$search."%'");
        }

        $total = $query->count();
        $result = $query->offset(($page -1) * $perpage)->limit($perpage)->get();

        return response()->json([
            "status_code" => "200",
            "status_message" => "le donnees ont ete recupere",
            "current_page" => $page,
            "last_page" => ceil($total/$perpage),
            "items"=>$result
        ]);

        }

        catch(Exception $e){
            return response()->json($e);
        }
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
