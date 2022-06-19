@extends('layouts.app')

@section('content')
    <h1>プロファイル</h3>
    <br>
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-body">
                </div>
                    <table class="table table-striped table-bordered">
                    <tr>
                        <td>氏名</th>
                        <td>{{ Auth::user()->name }}さん</th>
                    </tr>
                    <tr>
                        <td>所属／勤務先</td>
                        <td>{{ Auth::user()->affiliation }}</td>
                    </tr>
                    <tr>
                        <td>メールアドレス</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    </table>

            </div>
        </aside>
    </div>
    <button type="button " class="btn btn-secondary" onClick="history.back()">戻る</button>
@endsection