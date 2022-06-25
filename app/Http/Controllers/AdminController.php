<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;    // 追加

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // メッセージ一覧を取得
//        $reports = Report::all();
        $reports = Report::with('user')->get();

        // メッセージ一覧ビューでそれを表示
        return view('admin.index', [
            'reports' => $reports,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id<0) {
            $id = $id * -1;
            $status_value=0;
        } else {
            $status_value=1;
        }
        // idの値で投稿を検索して取得
        $report = \App\Report::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を変更
//        if (\Auth::id() === $report->user_id) {
            // ステータスを更新
            
            $report->status = $status_value;
            $report->save();
//        }
        // 前のURLへリダイレクトさせる
        return back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
