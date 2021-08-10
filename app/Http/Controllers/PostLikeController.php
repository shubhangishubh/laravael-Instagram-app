<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{

    //---------------[ Middleware ] -------------
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ----------- [ Logic to PostLike the user] -----------
    public function store(Post $post, Request $request)
    {

        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        return back();
    }
    public function destroy(Post $post, Request $request)
    {
        //$likes = $request->user()->likes->where('post_id', $post->id)->delete();
        $likes = Like::where('post_id', $post->id);
        $likes->delete();
        return back();
    }
}