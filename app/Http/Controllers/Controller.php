<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Auth;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
        // 全てのページで共通に使える情報をビューに送る
        $this->middleware(function ($request, $next) {
            $id = Auth::id();
            $followCount = \DB::table('follows')
                ->where('follower_id', $id)
                ->count();

            $followerCount = \DB::table('follows')
                ->where('followee_id', $id)
                ->count();

            $auth = Auth::user();

            $followed = $this->follow();
            View::share('auth', Auth::user());
            View::share('imageURL', asset('storage/usersIcon/' . $auth['image']));
            View::share('followCount', $followCount);
            View::share('followerCount', $followerCount);
            View::share('followed', $followed);

            return $next($request);
        });
    }

    protected function authInfo()
    {
        return Auth::user();
    }

    protected function authId()
    {
        return Auth::id();
    }

    protected function authName()
    {
        return Auth::user()['name'];
    }

    //ログインユーザーのフォロー
    protected function follow()
    {
        $list = \DB::table('follows')
            ->where('follower_id', '=', $this->authId())
            ->select('followee_id')
            ->get();
        $follow = (!is_object($list)) ? $list[0] : $list;
        $followArray = json_decode(json_encode($follow), true);

        $follower_id = [];
        for ($i = 0; $i < count($followArray); $i++) {
            array_push($follower_id, $followArray[$i]['followee_id']);
        }
        return $follower_id;
    }

    //ログインユーザーのフォロワー
    protected function follower()
    {
        $list = \DB::table('follows')
            ->where('followee_id', '=', $this->authId())
            ->get();
        return (!is_array($list)) ? $list[0] : $list;
    }
}
