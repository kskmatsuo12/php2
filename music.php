<?php

//曲登録画面で音楽を追加するときにAJAXで発動するページ
//ただ単に音楽とアーティスト名をセットで保存してるだけ。

$music_name = $_POST["music_name"];
$artist_name = $_POST["artist_name"];
//2. DB接続します
try {
    $pdo = new PDO('mysql:dbname=karaoke;charset=utf8;host=localhost', 'root', 'root');

    //   $pdo = new PDO('mysql:dbname=ksk-tennis_karaoke;charset=utf8;host=mysql743.db.sakura.ne.jp', 'ksk-tennis', 'yukitiindb11'); //root1個目はid、2個目はパスワード
} catch (PDOException $e) {
    exit('DB Error:'.$e->getMessage());
}
//３．データ登録SQL作成
$sql = "INSERT INTO music ( music_name,artist_name ) VALUES (:music_name,:artist_name)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':music_name', $music_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':artist_name', $artist_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status==false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQL Error:".$error[2]);
} else {
    echo "送信したっす";
  
    exit(); //終了のおまじない
}
