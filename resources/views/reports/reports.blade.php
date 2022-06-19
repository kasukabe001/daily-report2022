@if (count($reports) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>日付</th>
                    <th>報告内容</th>
                    <th></th>
                    <th>確認</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ Str::limit($report->created_at, 10,'') }}</td>
                    <td>{!! nl2br(e($report->report)) !!}</td>
                    <td>
                        @if ( $report->status!='1')
                            {!! link_to_route('reports.edit', '編集', ['report' => $report->id], ['class' => 'btn btn-success']) !!}
                        @endif
                    </td>
                    <td>
                    @if ( $report->status=='1') 確認済
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    {{-- ページネーションのリンク --}}
    {{ $reports->links() }}
@endif