@extends('layouts.login')

@section('content')

<div class="profile-area">
    <div class="user-icon">
        <img src="{{ $imageURL }}" alt="User Icon">
    </div>
    {!! Form::open(['url'=>'/profile/edit', 'files' => true, 'onsubmit'=>'confirm("プロフィール情報を変更します。よろしいでしょうか？")','enctype' => 'multipart/form-data']) !!}
        <div class="profile-items">
            <span class="label">UserName</span>
            {{Form::text('name', $auth['name'], ['class' => 'value'])}}
        </div>
        <div class="profile-items">
            <span class="label">MailAddress</span>
            {{Form::text('email', $auth['email'], ['class' => 'value'])}}
        </div>
        <div class="profile-items">
            <span class="label">Password</span>
            <p class='value'>{{ str_repeat('●', mb_strlen($count, 'UTF8'))}}</P>
        </div>
        <div class="profile-items">
            <span class="label">NewPassword</span>
            {{Form::password('new_password', ['class' => 'value'])}}
        </div>
        <div class='profile-items'>
            <span class="label">Bio</span>
            {{Form::textarea('bio', $auth['bio'], ['placeholder' => '自己紹介文', 'class' => 'value'])}}
        </div>
        <div class='profile-items'>
            <span class="label">IconImage</span>
            <div class="inner-container">
                <label class="btn btn-gray">{{Form::file('image', null, ['class' => 'profile-image'])}}ファイルを選択</label>
            </div>
        </div>

        <div class='profile-items'>
            {{Form::submit('更新',['class' => 'btn btn-green'])}}
        </div>
    {!! Form::close() !!}
@endsection
