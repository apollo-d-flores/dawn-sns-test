@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>DAWNSNSへようこそ</h2>
{{ Form::label('mailAddress') }}
{{ Form::text('email',null,['class' => 'input']) }}


{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}
<p class="error">{{ session('error') }}</p>

<div>{{ Form::submit('LOGIN') }}</div>

<div><a href="/register">新規ユーザーの方はこちら</a></div>

{!! Form::close() !!}

@endsection
