<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
        use App\Report;
        
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','affiliation','admin_flg'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * このユーザが所有する日報。（ Reportモデルとの関係を定義）
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('reports');
    }

    /**
     * $userIdで指定されたユーザが投稿済みかどうかチェックする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function check_post($userId)
    {
        // すでに投稿しているか
        $report = $this->is_posting($userId);

        if ($report) {
            // 投稿済み、かつ、自分自身でない場合はフォローを外す
            return $report;
        } else {
            // 上記以外の場合は何もしない
            return ;
        }
    }

    /**
     * 指定された $userIdのユーザが投稿済みであるか調べる。投稿済みならtrueを返す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function is_posting($userId)
    {
        $row="";
        $row = Report::where('user_id', $userId)->whereDate('created_at', date('Y-m-d'))->first();
//        $row = Report::select('id')->where('user_id', $userId)->whereDate('created_at', date('Y-m-d'))->first();
        if (!empty($row)) return $row;
    }

}
