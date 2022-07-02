@extends('layouts.app')

@section('content')
    <h1>本日の日報は登録済みで、管理者の確認も終了しています。</h1>
    <br>
    <div class="row">
        <label class="col-2 col-form-label font-weight-bold">ID / 日付</label>
        <div class="col-10 col-form-label font-weight-bold">報告内容</div>
    </div>
    <div class="row">
        <label class="col-2 col-form-label">{{ $report->id }} / {{ Str::limit($report->created_at, 10,'') }}</label>
        <div class="col-8">
            {{ $report->report }}
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-2 col-form-label"></div>
        <div class="col-8">
        {!! link_to_route('reports.index', '日報一覧', [Auth::id()], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endsection