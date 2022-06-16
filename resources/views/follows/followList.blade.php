@extends('layouts.login')

@section('content')

<div class="user-icon-list-area">
    <h1>Follow List</h1>
    <div class="user-icon-list">
        @if (is_null($followList))
            <p>フォローしているユーザーがいません。</p>
        @else
            @foreach($followList as $lists)
                <div class='user-icon'>
                    <a href="http://127.0.0.1:8000/other/profile/{{$lists->followee_id}}"><img src="{{ asset('/storage/usersIcon/'.$lists->image) }}"></a>
                </div>
            @endforeach
        @endif
    </div>
</div>
<hr class="gray-w4">
<div class="post-area">
    @if (is_null($followPost))
        <p>投稿がありません。</p>
    @else
        @foreach($followPost as $posts)
        <div class="post-info">
            <div class="user-icon">
                <a href="http://127.0.0.1:8000/other/profile/{{$posts->user_id}}"><img src="{{ asset('/storage/usersIcon/'.$posts->image) }}"></a>
            </div>
            <div class="user-post">
                <div class="row">
                    <span class="user-name">{{$posts->name}}</span>
                    <span class="date">{{$posts->updated_at}}</span>
                </div>
                <p class="post">{!! nl2br(e($posts->post)) !!}</p>
            </div>
        </div>
        <hr class="lightgray-w1">
        @endforeach
    @endif
</div>

@endsection
