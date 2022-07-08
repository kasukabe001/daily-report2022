<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['report','status','filename', 'new_filename'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * $他サーバへアップロードする。
     *
     * @param  string  $filePath
     * @param  string  $new_filename
     * @return array
     */
    public function other_upload($filePath,$new_filename)
    {
	      //1.アップロードされたファイルのパスとファイル名を取得する。
//	      $filePath = $_FILES['org_filename']['tmp_name'];
	      $fileName = basename($filePath);
	      //2.アップロードされたファイルの内容を取得する。
	      $file = file_get_contents($filePath);
	      //3.送信先URLを指定する。
	      $url = 'https://gairai.sakura.ne.jp/temp/obesity/file_receiptOnPublic.php?no=' . $new_filename;
	      //4.バウンダリを作成する。
	      $boundary = '--------------------------'.microtime(true);
	      //5.ヘッダーを作成する。
	      $headers = [
		'Accept-language: ja',
		'Cookie: hash=12345abcde',
		'Content-Type: multipart/form-data; boundary='.$boundary
	      ];
	      //6.ボディにファイル名とファイルの内容を詰め込む。
	    $content = '--'.$boundary."\r\n".
'Content-Disposition: form-data; name="userfile"; filename="'. $fileName . '"' . "\r\n" .
'Content-Type: text/plain'."\r\n\r\n".
$file ."\r\n".
'--'.$boundary.'--'."\r\n";
	      //7.送信先への送信データ(ヘッダ、ボディ)を作成する。
	      $opts['http'] = [
		'method' => 'POST',
		'header' => implode("\r\n", $headers),
		'content' => $content,
	      ];
	      $context = stream_context_create($opts);
	      //8.送信先へデータを送信する。
	      $ret = file_get_contents($url, false, $context);
	      // 9 結果判定
	      if($ret !== false){
//        echo $contents;//送信先の結果を出力
	      } else {
        	echo '送信失敗';
	      }

    }

}
