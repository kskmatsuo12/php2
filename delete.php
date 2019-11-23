<?php
//ポストの削除を受け取るファイル。
//ポストのIDを受ける

$id = $_GET["id"];

try {
    $pdo = new PDO('mysql:dbname=karaoke;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DB error:'.$e->getMessage());
}
$update = $pdo->prepare("DELETE FROM posts WHERE id=:id");
$update->bindValue(':id', $id, PDO::PARAM_INT);

$status = $update->execute();

header('Location: read.php');
