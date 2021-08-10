<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Models\Follow;
use App\Models\Followers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
   //---------------[ Middleware ] -------------
   public function __construct(){
      $this->middleware(['auth:api']);
   }

   public function getFollowersCount(Request $request, $user_id){
      $user_exists = User::where('id', '=', $user_id)->first();

      if(!empty($user_exists)){
         $followers = Followers::where('user_id', '=', $user_id)->get()->count();

         return response()->json(array(
             'data' => array(
                'followers'   => $followers
             ),
             'status' => true,
             'message' => array('Number of followers fetched')
         ), 200);
      } else {
         return response()->json(array(
             'data' => array(),
             'status' => false,
             'message' => array('User does not exists')
         ), 201);
      }
   }

   public function follow(Request $request, $user_id){

      $follower_id = $request->user()->id;
      $is_user_available = User::where('id', '=', $user_id)->first();

      if($follower_id == $user_id){
         return response()->json(array(
            'data' => array(),
            'status' => false,
            'message' => array('You cannot follow yourself.')
        ), 201);
      }

      if(!empty($is_user_available)){
         Followers::create([
            'user_id'      => $user_id,
            'follower_id'  => $follower_id
         ]);

         return response()->json(array(
             'data' => array(),
             'status' => true,
             'message' => array('Following')
         ), 200);
      } else {
         return response()->json(array(
             'data' => array(),
             'status' => false,
             'message' => array('User not available')
         ), 201);
      }
   }


   public function unfollow(Request $request, $user_id){

      $follower_id = $request->user()->id;
      $is_following = Followers::where('follower_id', '=', $follower_id)->where('user_id', '=', $user_id)->first();

      if(!empty($is_following)){
         $is_following->delete();

         return response()->json(array(
              'data' => array(),
              'status' => true,
              'message' => array('Unfollowing')
         ), 200);
      } else {
         return response()->json(array(
            'data' => array(),
            'status' => false,
            'message' => array('Unfollow')
       ), 201);
      }
   }

}