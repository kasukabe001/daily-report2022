@extends('layouts.app')

@section('content')
    <h1>プロファイル</h3>
    <br>
    <div class="row">
        <aside class="col-sm-4">
            <!-- div class="card" -->
                 <table class="table table-striped table-bordered">
                    <tr>
                        <td>氏名</th>
                        <td>{{ $user->name }}</th>
                    </tr>
                    <tr>
                        <td>所属／勤務先</td>
                        <td>{{ $user->affiliation }}</td>
                    </tr>
                    <tr>
                        <td class='text-nowrap'>メールアドレス</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                </table>
            <!-- /div -->
        </aside>
    </div>
    {!! link_to_route('users.edit', '編集', [Auth::user()->id], ['class' => 'btn btn-success text-nowrap']) !!}&nbsp;
    {!! link_to_route('reports.index', '日報一覧', [Auth::user()->id], ['class' => 'btn btn-secondary text-nowrap']) !!}&nbsp;
    <a class="btn btn-primary" href="/">日報登録</a>
    <!-- button type="button " class="btn btn-secondary" onClick="history.back()">戻る</button -->
@endsection