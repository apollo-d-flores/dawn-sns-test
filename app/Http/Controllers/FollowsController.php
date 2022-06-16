<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        $followList = \DB::table('follows')
            ->join('users', 'follows.followee_id', '=', 'users.id')
            ->where('follower_id', $this->authId())
            ->get();
        $followPost = \DB::table('posts')
            ->leftjoin('users', 'posts.user_id', '=', 'users.id')
            ->leftjoin('follows', 'follows.followee_id', '=', 'posts.user_id')
            ->where('follows.follower_id', $this->authId())
            ->get();
        return view('follows.followList', compact(['followList', 'followPost']));
    }

    public function followerList()
    {
        $followerList = \DB::table('follows')
            ->join('users', 'follows.followee_id', '=', 'users.id')
            ->where('followee_id', $this->authId())
            ->get();
        $followerPost = \DB::table('posts')
            ->leftjoin('users', 'posts.user_id', '=', 'users.id')
            ->leftjoin('follows', 'follows.follower_id', '=', 'posts.user_id')
            ->where('follows.followee_id', $this->authId())
            ->get();
        return view('follows.followerList', compact(['followerList', 'followerPost']));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('id');
            \DB::table('follows')->insert(
                ['followee_id' => $id, 'follower_id' => $this->authId()]
            );
            return back();
        }
    }
    public function delete(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('id');
            \DB::table('follows')
                ->where('followee_id', $id)
                ->where('follower_id', $this->authId())
                ->delete();
            return back();
        }
    }
}
