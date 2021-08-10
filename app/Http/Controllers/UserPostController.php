<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{

    // ----------- [ Return view] -----------
    public function index(User $user)
    {
        $post = $user->posts()->with(['user', 'likes'])->paginate(2);

        return view('users.posts.index', [
            'user' => $user,
            'posts' => $post
        ]);
    }
}