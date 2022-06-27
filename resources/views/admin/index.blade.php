@extends('admin.admin_app')

@section('content')

    <h1>日報一覧</h1>
    <br>

    <div class="col-sm-8">
        {{-- 投稿一覧 --}}
    @if (count($reports) > 0)
        注）確認済⇔未確認　クリックすると切り替わります。
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>日付</th>
                    <th>報告者名</th>
                    <th>報告内容</th>
                    <th class='text-nowrap'>確認</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td class='text-nowrap'>{{ Str::limit($report->created_at, 10,'') }}</td>
                    <td>{!! $report->user->name !!} ({!! $report->user_id !!})</td>
                    <td>{!! nl2br(e($report->report)) !!}</td>
                    <td>
                        @if($report->status==0)
                            {!! link_to_route('admin.edit', '未確認', [$report->id], ['class' => 'btn btn-primary text-nowrap']) !!} {{-- $report->status --}}
                            {{-- <a href="{{ route('admin.edit', \Auth::user()->id) }}">プロフィール</a> --}}
                        @else
                            {!! link_to_route('admin.edit', '確認済', [($report->id) * -1], ['class' => 'btn btn-success text-nowrap']) !!} {{-- $report->status --}}                             
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    </div>

@endsection