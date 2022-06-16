@extends('layouts.login')

@section('content')
<div class>
    <figure>
        <img src="/images/{{$otherProf[0]->image}}" class='icon'>
    </figure>
    <p>{{$otherProf[0]->name}} さん</p>
    <p>{{$otherProf[0]->bio}}</p>
</div>

<br><br>

<div class>
    @foreach($posts as $posts)
        <p>{{$posts->post}}</p>
        <p>{{$posts->post}}</p>
    @endforeach
</div>

@if(!in_array($otherProf[0]->id, $followed,true))
    {{ Form::open(['url' => '/follow/create']) }}
    {{ Form::hidden('id', $otherProf[0]->id) }}
    {{ Form::submit('フォローする',['class'=>'btn btn-add'])}}
    {{ Form::close() }}
@else
    {{ Form::open(['url' => '/follow/delete']) }}
    {{ Form::hidden('id', $otherProf[0]->id) }}
    {{ Form::submit('フォローをはずす',['class'=>'btn btn-add'])}}
    {{ Form::close() }}
@endif

@endsection

<script type="text/javascript">
    function confirm() {
        //入力ボックスの内容を表示する
        alert('プロフィール情報を変更します。よろしいでしょうか？');
    }
</script>
