@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>日報登録サービス</h1>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', '会員登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
            {{-- ログインページへのリンク --}}
           {!! link_to_route('signup.get', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}動作しません
        </div>
    </div>
@endsection
