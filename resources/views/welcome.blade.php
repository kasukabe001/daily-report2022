@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>日報登録サービス</h1>
            <br>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', '会員登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
            &emsp;
            {{-- ログインページへのリンク --}}
           {!! link_to_route('signup.get', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endsection
