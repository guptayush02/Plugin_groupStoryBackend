<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function signUp(Request $request){
        $data = $request->all();
        $existingUser = DB::table('users')->where('email', $data['email'])->first();
        if(empty($existingUser)) {
            $user = DB::table('users')->insert(['name' => $data['name'], 'email' => $data['email'], 'password' => $data['pass'], 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()]);
        }
        if($user){
            $responce['status'] = true;
            $responce['name'] = $data['name'];
            $responce['email'] = $data['email'];
        }
        return $responce;
    }

    public function login(Request $request){
        $data = $request->all();
        $user = DB::table('users')->where(['email' => $data['email'], 'password' => $data['pass']])->first();
        if($user){
            $responce['status'] = true;
            $responce['data'] = $user;
        }
        return $responce;
    }

    public function storyPost(Request $request){
        $data = $request->all();
        if (!empty($data['storyId'])) {
            $userStory = DB::table('stories')->where('id', $data['storyId'])->update(['description' => $data['story'], 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()]);
        }else{
            $userStory = DB::table('stories')->insert(['description' => $data['story'], 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()]);
        }
        $story = DB::table('stories')->where('description', $data['story'])->first();
        $data = DB::table('user_story')->insert(['user_id' => $data['userId'], 'story_id' => $story->id]);
        if ($userStory && $data) {
            $responce['status'] = true;
            $responce['data'] = $story;
        }
        return $responce;
    }

    public function getStory(Request $request){

        $story = DB::table('stories')->get();
        if ($story) {
            $responce['status'] = true;
            $responce['story'] = $story;
        }else{
            $responce['status'] = 'empty';
        }
        return $responce;
    }

    public function story(Request $request){
        $storyId = $request->get('storyId');
        $story = DB::table('stories')->where('id', $storyId)->first();
        if($story){
            $response['status'] = true;
            $response['data'] = $story;
        }
        return $response;
    }
}
