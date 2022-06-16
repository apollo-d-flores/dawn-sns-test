<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected $validateRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'bio' => 'max:400',
        'image' => 'image'
    ];

    protected $validateMessages = [
        'name.required' => '名前は必ず入力しましょう',
        'name.max255' => '入力の上限を超えています',
        'name.email' => 'メールアドレスの形式ではございません',
        'bio.max:400' => '入力の上限を超えています',
        'image.image' => 'ファイルの形式が画像ではありません'
    ];

    protected function update(array $data)
    {
        if (is_null($data['new_password'])) {
            return \DB::table('users')
                ->where('id', $this->authId())
                ->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'bio' => $data['bio'],
                    'image' => $data['image'],
                ]);
        } else {
            return \DB::table('users')
                ->where('id', $this->authId())
                ->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'bio' => $data['bio'],
                    'image' => $data['image'],
                    'password' => bcrypt($data['new_password']),
                ]);
        }
    }

    public function profile()
    {
        $auth = $this->authInfo();
        $count = session()->get('wordCount');
        return view('users.profile', compact(['auth', 'count']));
    }

    //画像アップロードの際にやっておくコマンド → php artisan storage:link
    public function edit(Request $request)
    {
        $data = $request->input();
        $auth = \Auth::user();
        if ($request->isMethod('post')) {
            $val = Validator::make(
                $data,
                $this->validateRules,
                $this->validateMessages
            );
            if ($val->fails()) {
                return redirect('/profile')->withErrors($val)->withInput();
            } else {
                //画像のアップロード
                if (is_null($request->file('image'))) {
                    if ($auth['image'] === 'dawn.png') {
                        $data['image'] = 'dawn.png';
                    } else {
                        $data['image'] = $auth['image'];
                    }
                } else {
                    $request->file('image')->storeAs('usersIcon', $this->authName() . ".png", ['disk' => 'public']);
                    $data['image'] = $this->authName() . ".png";
                }
                //DBの更新
                $this->update($data);
                return redirect('/top');
            }
        }
        return redirect('/top');
    }

    public function search()
    {
        $lists = \DB::table('users')
            ->where('id', '<>', $this->authId())
            ->get();
        $followed = $this->follow();
        return view('users.search', compact(['lists', 'followed']));
    }

    public function result(Request $request)
    {
        $name = $request->input('search');
        $lists = \DB::table('users')
            ->where('id', '<>', $this->authId())
            ->where('name', 'like', "%{$name}%")
            ->get();
        $followed = $this->follow();
        return view('users.search', compact(['lists', 'followed']));
    }

    public function otherUser($id = null)
    {
        $otherProf = \DB::table('users')
            ->where('users.id', $id)
            ->get();
        $posts = \DB::table('posts')
            ->join('users', 'posts.user_id', 'users.id')
            ->where('posts.user_id', $id)
            ->get();
        return view('users.otherInfo', compact(['otherProf', 'posts']));
    }
}
