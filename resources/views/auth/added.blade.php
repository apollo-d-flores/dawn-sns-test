@extends('layouts.logout')

@section('content')
<div class="complete" id="clear">
  <div class="username">{{ Session('name') }}さん</div>
  <p>ようこそ！ DAWNSNSへ</p>
  <p>ユーザー登録が完了しました。<br>さっそく、ログインをしてみましょう</p>

  <a class="btn" href="/login">ログイン画面へ</a>
</div>

@endsection