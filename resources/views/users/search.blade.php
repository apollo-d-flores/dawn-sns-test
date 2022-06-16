@extends('layouts.login')

@section('content')
<div class="user-search-form-area">
    {{ Form::open(['url' => '/search/result']) }}
    {{ Form::label('ユーザー名') }}
    {{ Form::text('search',null,['placeholder' => 'ユーザー名']) }}
    {{ Form::image('images/search.png') }}
    {{ Form::close() }}
</div>
<hr class="gray-w4">
<div class="user-list-area">
    <div class="user-list">
        @if (is_object($lists))
        @foreach ($lists as $list)
        <div class="user-info">
            <div class="user-icon">
                <a href="http://127.0.0.1:8000/other/profile/{{$list->id}}"><img src="{{ asset('/storage/usersIcon/'.$list->image) }}"></a>
            </div>
            <div class="user-name-area"><span class="user-name">{{ $list->name }}</span></div>
            @if (!in_array($list->id, $followed, true))
            {{ Form::open(['url' => '/follow/create']) }}
            {{ Form::hidden('id', $list->id) }}
            {{ Form::submit('フォローする', ['class'=>'btn btn-blue'])}}
            {{ Form::close() }}
            @else
            {{ Form::open(['url' => '/follow/delete']) }}
            {{ Form::hidden('id', $list->id) }}
            {{ Form::submit('フォローをはずす', ['class'=>'btn btn-red'])}}
            {{ Form::close() }}
            @endif
        </div>
        @endforeach
        @else
        <p>ユーザーが存在しません。</p>
        @endif
    </div>
</div>

@endsection
