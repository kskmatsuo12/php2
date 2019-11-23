<?php
$user_name = $_POST["change_name"];
$favorite_music = $_POST["change_favorite"];
$id = $_POST["change_id"];
echo $id;

try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=karaoke;charset=utf8;host=localhost', 'root', 'root');

    // $pdo = new PDO('mysql:dbname=ksk-tennis_karaoke;charset=utf8;host=mysql743.db.sakura.ne.jp', 'ksk-tennis', 'yukitiindb11');
} catch (PDOException $e) {
    exit('DB Error:'.$e->getMessage());
}

//３．デーz１タ登録SQL作成
$sql = "UPDATE user SET username=:username, favorite=:favorite WHERE id=:id";

// $sql = "INSERT INTO user (username , favorite_music ) VALUES (:username,:favorite_music)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $user_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':favorite', $favorite_music, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行
// var_dump("aaa");
//debagよう
//４．データ登録処理後
if ($status==false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("SQL Error:".$error[2]);
} else {
    //５．index.phpへリダイレクト
    echo "送信したっす";
    header("Location: frontpage.php");
    exit(); //終了のおまじない
}
