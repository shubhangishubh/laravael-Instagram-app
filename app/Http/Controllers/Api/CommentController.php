<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //---------------[ Middleware ] -------------
    public function __construct(){
        $this->middleware(['auth:api']);
    }

    public function getCommentOfCurrentUser(Request $request){
        $user_id = $request->user()->id;

        $comments = Comment::where('user_id', '=', $user_id)->get();

        return response()->json(array(
            'data' => $comments,
            'status' => true,
            'message' => array('Comments Fetched!')
        ), 200);
    }

    public function getCommentByUserId(Request $request, $user_id){
        $comments = Comment::where('user_id', '=', $user_id)->get();

        return response()->json(array(
            'data' => $comments,
            'status' => true,
            'message' => array('Comments Fetched!')
        ), 200);
    }

    public function getCommentByPostId(Request $request, $post_id){
        $comments = Comment::where('post_id', '=', $post_id)->get();

        return response()->json(array(
            'data' => $comments,
            'status' => true,
            'message' => array('Comments Fetched!')
        ), 200);
    }

    public function addComment(Request $request, $post_id){
        // Validate
        $this->validate($request, [
            'comments' => 'required|string',
        ]);

        $user_id = $request->user()->id;

        $comment_id = Comment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comments' => $request->comments,
        ])->id;

        return response()->json(array(
            'data' => array(
                'comment_id' => $comment_id
            ),
            'status' => true,
            'message' => array('Comment Added!')
        ), 200);
    }

    public function editComment(Request $request, $post_id){
        // Validate
        $this->validate($request, [
            'comment_id'    => 'required|numeric',
            'comment'       => 'required|string'
        ]);

        $user_id = $request->user()->id;
        $comment_id = $request->comment_id;

        $comment = Comment::where('id', '=', $comment_id)->where('user_id', '=', $user_id)->where('post_id', '=', $post_id)->first();

        if(!empty($comment)){
            $comment->comments = $request->comment;
            $comment->save();

            return response()->json(array(
                'data' => $comment,
                'status' => true,
                'message' => array('Comment Updated!')
            ), 200);
        } else {
            return response()->json(array(
                'data' => array(),
                'status' => false,
                'message' => array('Comment Not Found!')
            ), 201);
        }
    }

    public function deleteComment(Request $request, $comment_id){
        $comment = Comment::where('id', '=', $comment_id)->first();

        if(!empty($comment)){
            $comment->delete();

            return response()->json(array(
                'data' => array(),
                'status' => true,
                'message' => array('Comment Deleted!')
            ), 200);
        } else {
            return response()->json(array(
                'data' => array(),
                'status' => false,
                'message' => array('Comment Not Found!')
            ), 201);
        }
    }
}