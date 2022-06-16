@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>
{{ Form::label('userName') }}
{{ Form::text('name',null,['class' => 'input']) }}
@if ($errors->has('name'))
  <p class="error">{{ $errors->first('name') }}</p>
@endif

{{ Form::label('mailAddress') }}
{{ Form::text('email',null,['class' => 'input']) }}
@if ($errors->has('email'))
  <p class="error">{{ $errors->first('email') }}</p>
@endif

{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}
@if ($errors->has('password'))
  <p class="error">{{ $errors->first('password') }}</p>
@endif

{{ Form::label('password confirm') }}
{{ Form::password('password-confirm',['class' => 'input']) }}
@if ($errors->has('password-confirm'))
  <p class="error">{{ $errors->first('password-confirm') }}</p>
@endif

<div>{{ Form::submit('REGISTER') }}</div>

<div><a href="/login">ログイン画面へ戻る</a></div>

{!! Form::close() !!}


@endsection
