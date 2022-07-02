@extends('layouts.app')

@section('content')

    <h1>日報の編集</h1>
    <br>

    <!-- div class="form-group row" -->
    <div class="row">
        <label class="col-2 col-form-label font-weight-bold">ID / 日付</label>
        <div class="col-10 col-form-label font-weight-bold">報告内容</div>
    </div>
    <div class="row">
        <label class="col-2 col-form-label">{{ $report->id }} / {{ Str::limit($report->created_at, 10,'') }}</label>
        <div class="col-10">
            {!! Form::model($report, ['route' => ['reports.update', $report->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::textarea('report', null, ['class' => 'form-control', 'rows' => '3']) !!}
                </div>
                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <label class="col-2 col-form-label"></label>
        <div class="col-10">
            <br>
            {{-- メッセージ削除フォーム --}}
            {!! Form::model($report, ['route' => ['reports.destroy', $report->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <label class="col-2 col-form-label"></label>
        <div class="col-10">
            <br>
           {!! link_to_route('reports.index', 'キャンセル', [Auth::id()], ['class' => 'btn btn-secondary']) !!}
        </div>
    </div>    

@endsection