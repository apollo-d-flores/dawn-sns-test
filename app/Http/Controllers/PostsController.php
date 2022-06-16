<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    //トップページ
    public function index(){
        $posts = \DB::table('posts')
                    ->leftJoin('users','posts.user_id','=','users.id')
                    ->where(['user_id' => $this->authId()])
                    ->select('posts.id', 'posts.user_id', 'posts.post', 'posts.updated_at', 'users.name', 'users.image')
                    ->get();
        return view('posts.index',compact('posts'));
    }

    //投稿-登録機能
    public function post_add(Request $request){
        $post =  $request->input('post');

        if($request->isMethod('post')){
            if(!empty($post)){
                \DB::table('posts')->insert(
                    ['user_id' => $this->authId(), 'post' => $post]
                );
                return redirect('/top');
            }
        return redirect('/top');
        }
    }

    //投稿-更新機能
    public function post_edit(Request $request){
        $editData = $request->all();
        if($request->isMethod('post')){
            if(!empty($editData['post'])){
                \DB::table('posts')
                    ->where('id',$editData['id'])
                    ->update([
                        'post' => $editData['post']
                    ]);
            }
        }
        return redirect('/top');
    }

    //投稿-削除機能
    public function post_delete($id = null){
        if($id){
            \DB::table('posts')->delete(
                ['id' => $id]
            );
        }
        return redirect('/top');
    }
}
