<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowersController extends Controller
{
    //---------------[ Middleware ] -------------
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ----------- [ Logic to PostLike the user] -----------
    public function store(Follow $follow, Request $request)
    {

        if ($follow->followedBy($request->user())) {
            return response(null, 409);
        }
        $follow->followers()->create([
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