@extends('layouts.app')

@section('content')
{{--    @if (Auth::check())  --}}
    <h1>日報一覧</h1>
    <br>
    <p class="font-weight-bold">{{ Auth::user()->name }}さん</p>
    <div class="col-sm-8">
        {{-- 投稿一覧 --}}
        @include('reports.reports')
    </div>
{{--    @else --}}
{{--    @endif --}}

@endsection