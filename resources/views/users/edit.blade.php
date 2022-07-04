@extends('layouts.app')

@section('content')
    <h1>プロファイル編集</h3>
    <br>
    <div class="row">
        <aside class="col-sm-4">
            <!-- div class="card" -->
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                 <table class="table table-striped table-bordered">
                    <tr>
                        <td>氏名</th>
                        <td>{!! Form::text('name', null, ['class' => 'form-control']) !!}</th>
                    </tr>
                    <tr>
                        <td>所属／勤務先</td>
                        <td>{!! Form::text('affiliation', null, ['class' => 'form-control']) !!}</td>
                    </tr>
                    <tr>
                        <td class='text-nowrap'>メールアドレス</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                </table>
                {!! link_to_route('users.show', '戻る', ['user' => Auth::id()], ['class'=>'btn btn-secondary']) !!}
                {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            <!-- /div -->
        </aside>
    </div>
@endsection