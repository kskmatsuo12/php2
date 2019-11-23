<?php
session_start();

$user = $_SESSION['login_user'];

$id = $_POST["id"];
$title = $_POST["title"];
$artist = $_POST["artist"];
$innumber = $_POST["innumber"];
$comment = $_POST["comment"];

try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=karaoke;charset=utf8;host=localhost', 'root', 'root');

    // $pdo = new PDO('mysql:dbname=ksk-tennis_karaoke;charset=utf8;host=mysql743.db.sakura.ne.jp', 'ksk-tennis', 'yukitiindb11');
} catch (PDOException $e) {
    exit('DB Connection Error'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "UPDATE posts SET  user=:user, title=:title, artist=:artist, comment=:comment, innumber=:innumber WHERE id=:id";
$update = $pdo->prepare($sql);
$update->bindValue(':id', $id, PDO::PARAM_INT);
$update->bindValue(':user', $user, PDO::PARAM_STR);
$update->bindValue(':title', $title, PDO::PARAM_STR);
$update->bindValue(':artist', $artist, PDO::PARAM_STR);
$update->bindValue(':innumber', $innumber, PDO::PARAM_INT);
$update->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $update->execute();

//３．データ表示

$view="";
if ($status==false) {
    $error = $stmt->errorInfo();
    exit("SQLerror:".$error[2]);
} else {
    echo '送信完了';
    header('Location: read.php');
};
