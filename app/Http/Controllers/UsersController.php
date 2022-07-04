<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加

class UsersController extends Controller
{

    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
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
        $user = User::findOrFail($id);

        // 編集ビューでそれを表示
        return view('users.edit', [
            'user' => $user,
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
            'name' => ['required', 'string', 'max:255'],
            'affiliation' => ['max:255'],
        ]);

        // idの値で投稿を検索して取得
        $user = \App\User::findOrFail($id);

        // ユーザ情報を更新
        $user->name = $request->name;
        $user->affiliation = $request->affiliation;
        $user->save();

        // 表示ページへリダイレクトさせる
        return view('users.show', [
            'user' => $user,
        ]);
    }

}
