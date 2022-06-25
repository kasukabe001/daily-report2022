@extends('layouts.app')

@section('content')
    @if (Auth::check())
            <div class="col-sm-8">
        {{--        @if (Auth::user()->admin_flg=='1')
                    管理者です。
                @endif   --}}
                {{-- 投稿フォーム --}}
                @include('reports.form')
                {{-- 投稿一覧 --}}
        {{--    @include('reports.reports') --}}
            </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>日報登録サービス</h1>
                <br>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', '会員登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
                &emsp;
                {{-- ログインページへのリンク --}}
                {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection
