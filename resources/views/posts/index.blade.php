@extends('layouts.login')

@section('content')
<div class="post-form-area">
    <div class="post-form-container">
        <div class="user-icon">
            <img src="{{ $imageURL }}">
        </div>
        {{ Form::open(['url' => '/post/create']) }}
        {{ Form::textarea('post', null, ['placeholder' => '何をつぶやこうか...?']) }}
        <div class="btn-area">
        {{ Form::image('images/post.png') }}
        </div>
        {{ Form::close() }}
    </div>
</div>
<hr class="gray-w4">
<div class="post-area">
    <div class="post-info-container">
        @foreach($posts as $posts)
        <div class="post-info">
            <div class="user-icon">
                <img src="{{ $imageURL }}">
            </div>
            <div class="user-post">
                <div class="row">
                    <span class="user-name">{{$posts->name}}</span>
                    <span class="date">{{$posts->updated_at}}</span>
                </div>
                <p class="post">{!! nl2br(e($posts->post)) !!}</p>
                <div class="btn-area">
                    <div class="edit-btn">
                        <img src="/images/edit.png">
                        <p class="post-no">{{ $posts->id }}</p>
                    </div>
                    <a class="delete-btn" href="/post/delete/{{$posts->id}}"><div class="btn-img"></div></a>
                </div>
            </div>
        </div>
        <hr class="lightgray-w1">
        @endforeach
    </div>
</div>


    <div id="overlay"></div>
    <div id="editModal" class="modal">
        <div class="modal-container">
        {{ Form::open(['url' => '/post/edit', 'onsubmit'=>'confirm("この投稿を変更します。よろしいでしょうか？")']) }}
        {{ Form::hidden('id', null, ['class' => 'edit-post-no']) }}
        {{ Form::textarea('post', null, ['class' => 'edit-post']) }}
        <div class="btn-area">
        {{ Form::image('images/edit.png') }}
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
