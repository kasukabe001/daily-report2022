@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>日報登録サービス</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}

            {{-- ユーザ登録ページへのリンク --}}
            <p class="mt-2">新規登録? {!! link_to_route('signup.get', '会員登録') !!}</p>
        </div>
    </div>
    <p><span class="badge badge-danger">管理者</span> admin@mail.com&emsp;test1234</p>
@endsection