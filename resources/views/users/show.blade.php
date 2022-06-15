@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">プロファイル</h3>
                </div>
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
@endsection