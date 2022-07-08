<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;     // 追加

use App\User;       // 追加

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $url=url()->current();

        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            if (strpos($url,"reports")>0) {
                // ユーザの日報の一覧を作成日時の降順で取得
                $reports = $user->reports()->orderBy('created_at', 'desc')->paginate(10);
                $data = [
                    'user' => $user,
                    'reports' => $reports,
                ];
                return view('reports.daily_reports', $data);
            }
             // 同日に投稿された日報があるかどうかをチェック
            $report = $user->is_posting($user->id);

            if ($report==null) {
                // 投稿済ではない場合、Welcomeビューで登録画面を表示
                return view('welcome');               
            } else {
                if ($report->status==1) { // 管理者確認済
                    return redirect()->action('ReportsController@show', [$report->id]);  
                } else { // 編集画面を表示  
                    return redirect()->action('ReportsController@edit', [$report->id]);                    
                }
            }
        }        
        return view('welcome');
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
            'filename' => 'max:1012|mimes:jpeg,jpg,gif,png',
        ],
        [
            'report.required' => '必須項目です。',
            'filename.max' => '1MB以内です。',
            'filename.mimes' => '画像ファイルをアップロードできます。'
        ]
        );

        // アップロード時のオリジナルのファイル名
        $original_file_name = $request->file('filename')->getClientOriginalName();
        // 新ファイル名
        $new_filename = date('mdHis') . "_" . $original_file_name;

        // storage/app/upfiles配下にアップロード
//        $request->filename->storeAs('public/img', $new_filename );

        // gairaiサーバにアップロード
        $filePath=$request->file('filename')->getPathname();
        $report = new Report();
        $report->other_upload($filePath,$new_filename);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->reports()->create([
            'report' => $request->report,
            'filename' => $original_file_name,
            'new_filename' => $new_filename,
        ]);

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

        // 日報詳細ビューでそれを表示
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
