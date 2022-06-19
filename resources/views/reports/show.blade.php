@extends('layouts.app')

@section('content')

    <h1>id = {{ $report->id }} のメッセージ詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $report->id }}</td>
        </tr>
        <tr>
            <th>タイトル</th>
             <td>{{ $report->created_at }}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $report->report }}</td>
        </tr>
    </table>

    {{-- メッセージ編集ページへのリンク --}}
    {!! link_to_route('reports.edit', 'このメッセージを編集', ['report' => $report->id], ['class' => 'btn btn-light']) !!}

    {{-- メッセージ削除フォーム --}}
    {!! Form::model($report, ['route' => ['reports.destroy', $report->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection