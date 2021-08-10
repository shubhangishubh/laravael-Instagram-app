<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    //---------------[ Middleware ] -------------
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ----------- [ Return view] -----------
    public function index()
    {

        $posts = Post::orderBy('created_at','desc')->with(['user', 'likes'])->paginate(2);
        return view('posts.index', [
            'posts' => $posts,
        ]);


    }
    // ----------- [ Logic to Post the user] -----------
    public function store(Request $request)
    {

        // ----------- [ Form validate ] -----------
        $this->validate($request, [
            'body'              =>   'required',
        ]);

        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();
    }
    public function destroy(Post $post)
    {
        if (!$post->ownedBy(auth()->user())) {

        }

        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}