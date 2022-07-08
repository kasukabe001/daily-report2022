<script type="text/javascript">
window.addEventListener('DOMContentLoaded', function(){
  $("[name='filename']").on('change', function (e) {
    
    var reader = new FileReader();

    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }

    reader.readAsDataURL(e.target.files[0]);   

  });
});
</script>

<h1>日報の登録</h1>
<br>
<p class="font-weight-bold text-center">ようこそ、{{ Auth::user()->name }}さん</p>
<br>

    <div class="form-group row">
        <label class="col-2 col-form-label">今日の日付</label>
        <div class="col-10 col-form-label font-weight-bold">報告内容</div>
    </div>

{!! Form::open(['route' => 'reports.store', 'files' => true]) !!}
    <div class="form-group row">
        <label class="col-2 col-form-label">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</label>
        <div class="col-10">
            {!! Form::textarea('report', null, ['class' => 'form-control', 'rows' => '3']) !!}
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-2 col-form-label">写真</label>
        <div class="col-10">
            {!! Form::file('filename', ['class'=>'form-control','id'=>'filename']) !!}
        </div>
    </div>
    
    <div class="text-center">
        {!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
    </div>
    <img id="preview" width="200px">
{!! Form::close() !!}
