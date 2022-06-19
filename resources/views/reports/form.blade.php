<h1>日報の登録</h1>
<br>
<p class="font-weight-bold text-center">ようこそ、{{ Auth::user()->name }}さん</p>
<br>

    <div class="form-group row">
        <label class="col-2 col-form-label">今日の日付</label>
        <div class="col-10 col-form-label">報告内容</div>
    </div>
    
{!! Form::open(['route' => 'reports.store']) !!}
    <div class="form-group row">
        <label class="col-2 col-form-label">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</label>
        <div class="col-10">
            {!! Form::textarea('report', null, ['class' => 'form-control', 'rows' => '3']) !!}
        </div>
    </div>
    <div class="text-center">
        {!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}
