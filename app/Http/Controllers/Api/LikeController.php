<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{

    //---------------[ Middleware ] -------------
    public function __construct(){
        $this->middleware(['auth:api']);
    }

    public function getLikesOfPost($post_id){

        $numberOfLikes = Like::where('post_id', '=', $post_id)->get();

        return response()->json(array(
            'data' => array(
                'number_of_like' => $numberOfLikes->count()
            ),
            'status' => true,
            'message' => array('Get total likes')
        ), 200);
    }

    public function likePostAction(Request $request, $post_id){
        $user_id = $request->user()->id;

        $is_liked = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->get();

        if($is_liked->count()){
            return response()->json(array(
                'data' => array(),
                'status' => false,
                'message' => array('Already Liked')
            ), 201);
        } else {
            Like::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
            ]);

            return response()->json(array(
                'data' => array(),
                'status' => true,
                'message' => array('Liked')
            ), 200);
        }
    }

    public function unlikePostAction(Request $request, $post_id){

        $user_id = $request->user()->id;

        $is_liked = Like::where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->first();

        if(!empty($is_liked)){

            $is_liked->delete();

            return response()->json(array(
                'data' => array(),
                'status' => true,
                'message' => array('Like Deleted!')
            ), 200);

        } else {
            return response()->json(array(
                'data' => array(),
                'status' => false,
                'message' => array('Not Liked Yet')
            ), 201);
        }
    }
}