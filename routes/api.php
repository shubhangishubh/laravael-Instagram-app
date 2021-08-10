<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout']);


Route::get('/total-posts/{user_id}', [PostController::class, 'getTotalPost']);
Route::post('/post', [PostController::class, 'Post']);
Route::delete('/delete-post/{post_id}', [PostController::class, 'deletePost']);

Route::get('/comment', [CommentController::class, 'getCommentOfCurrentUser']);
Route::get('/comment/user/{user_id}', [CommentController::class, 'getCommentByUserId']);
Route::get('/comment/post/{post_id}', [CommentController::class, 'getCommentByPostId']);
Route::post('/comment/{post_id}', [CommentController::class, 'addComment']);
Route::post('/comment/edit/{post_id}', [CommentController::class, 'editComment']);
Route::delete('/comment/{comment_id}', [CommentController::class, 'deleteComment']);


Route::get('/total-likes/{post_id}', [LikeController::class,  'getLikesOfPost']);
Route::post('/like/{post_id}', [LikeController::class,  'likePostAction']);
Route::delete('/unlike/{post_id}', [LikeController::class,  'unlikePostAction']);

Route::get('/follow/count/{user_id}', [FollowController::class, 'getFollowersCount']);
Route::post('/follow/{user_id}', [FollowController::class,  'follow']);
Route::delete('/unfollow/{user_id}', [FollowController::class,  'unfollow']);