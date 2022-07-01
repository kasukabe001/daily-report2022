@extends('layouts.app')

@section('content')
    <h1>本日の日報は登録済みで、管理者の確認も終了しています。</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $report->id }}</td>
        </tr>
        <tr>
            <th>日付</th>
             <td>{{ $report->created_at }}</td>
        </tr>
        <tr>
            <th>報告内容</th>
            <td>{{ $report->report }}</td>
        </tr>
    </table>

    {{-- メッセージ編集ページへのリンク --}}
{{--    {!! link_to_route('reports.edit', 'このメッセージを編集', ['report' => $report->id], ['class' => 'btn btn-light']) !!} --}}
    {!! link_to_route('reports.index', '日報一覧', [Auth::id()], ['class' => 'btn btn-lg btn-primary']) !!}
    {{-- メッセージ削除フォーム --}}
{{--   
    {!! Form::model($report, ['route' => ['reports.destroy', $report->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
--}}
@endsection