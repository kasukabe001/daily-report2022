@extends('layouts.app')

@section('content')

    <h1>日報一覧</h1>
    <br>
    <p class="font-weight-bold">{{ Auth::user()->name }}さん</p>
    <div class="col-sm-8">
        {{-- 投稿一覧 --}}
        @include('reports.reports')
    </div>

    <a class="btn btn-primary" href="/">日報登録</a>
@endsection