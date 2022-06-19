<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;    // 追加

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの日報の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $reports = $user->reports()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'reports' => $reports,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('reports.daily_reports', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'report' => 'required|max:255',
        ]);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->reports()->create([
            'report' => $request->report,
        ]);

        // 前のURLへリダイレクトさせる
        //        return back();

        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの日報の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $reports = $user->reports()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'reports' => $reports,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('reports.daily_reports', $data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // idの値でタスクを検索して取得
        $report = Report::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、トップページへリダイレクトさせる
        if (\Auth::id() !== $report->user_id) {
            return redirect('/');
        }

        // タスク詳細ビューでそれを表示
        return view('reports.show', [
            'report' => $report,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値でタスクを検索して取得
        $report = Report::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、トップページへリダイレクトさせる
        if (\Auth::id() !== $report->user_id) {
            return redirect('/');
        }

        // タスク編集ビューでそれを表示
        return view('reports.edit', [
            'report' => $report,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'report' => 'required|max:255'
        ]);

        // idの値で投稿を検索して取得
        $report = \App\Report::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を変更
        if (\Auth::id() === $report->user_id) {
            // タスクを更新
            $report->report = $request->report;
            $report->save();
        }

         // 日報一覧へリダイレクトさせる
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの日報の一覧を作成日時の降順で取得
            $reports = $user->reports()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'reports' => $reports,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('reports.daily_reports', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $report = \App\Report::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $report->user_id) {
            $report->delete();
        }

         // 日報一覧へリダイレクトさせる
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの日報の一覧を作成日時の降順で取得
            $reports = $user->reports()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'reports' => $reports,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('reports.daily_reports', $data);
    }
}
