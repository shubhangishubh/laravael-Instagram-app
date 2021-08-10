<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    //---------------[ Middleware ] -------------
    public function __construct(){
        $this->middleware(['auth:api']);
    }

    public function getTotalPost($user_id){

        $numberOfPost= Post::where('user_id', '=', $user_id);

        return response()->json(array(
            'data' => array(
                'number_of_post' => $numberOfPost->count()
            ),
            'status' => true,
            'message' => array('Get total posts')
        ), 200);
    }


    public function Post(Request $request)
    {

        // ----------- [ Form validate ] -----------
        $this->validate($request, [
            'body'              =>   'required',
        ]);

        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return response()->json(array(
            'data' => array(),
            'status' => true,
            'message' => array('User uploaded post!')
        ), 200);
    }

    public function deletePost($post_id){
        $post = Post::where('id', '=', $post_id)->first();

        if(!empty($post)){
            $post->delete();

            return response()->json(array(
                'data' => array(),
                'status' => true,
                'message' => array('Post deleted!')
            ), 200);
        } else {
            return response()->json(array(
                'data' => array(),
                'status' => false,
                'message' => array('No Post Found!')
            ), 201);
        }
    }
}