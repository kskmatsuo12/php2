<?php
//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=karaoke;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DB Connection Error'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM posts LIMIT 100";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQLerror:".$error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //$r["id"],$r["name"],$r["email"],$r["naiyou"]
        // $user .= $r["user"];
        // $title .= $r["title"];
        // $artist .= $r["artist"];
        // $innumber .= $r["innumber"];
        // $comment .= $r["comment"];

        // $view .= "<tr><td>".$r["id"]."</td><td>".$r["name"]."</td></tr>";
        $view .= "<tbody><tr><td scope='row'>".$r['indate']."</td><td><form method='post' action='user.php'><input name='get_user' type='submit' value='".$r['user']."'></form></td><td><form method='post' action='category_music.php'><input name='get_music' type='submit' value='".$r['title']."'></form></td><td><form method='post' action='category_artist.php'><input type='submit' name='get_artist' value='".$r['artist']."'></form></td><td>".$r['innumber']*(1/10)."</td><td>".$r['comment']."</td></tr></tbody>";
    }
};
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>カラオケの点数表</title>
<link rel="stylesheet" href="css/range.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>
div {
  padding: 10px;font-size:16px;
  }
  td{
    padding: 5px;
    background: #fff;
  }
  input {
    border: 0px;
    color: blue;
  }

</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">みんなのカラオケ点数</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">日付</th>
      <th scope="col">ユーザー</th>
      <th scope="col">曲名</th>
      <th scope="col">アーティスト</th>
      <th scope="col">点数</th>
      <th scope="col">コメント</th>
    </tr>
  </thead>
      <?= $view ?>
</table>
<form method="post"  action="user.php">
<span>お名前DE検索ボックス</span>
  <input class="form-control" name="get_user">
  <button class="btn btn-outline-secondary" type="submit" id="button-addon1">名前で検索する</button>
</form>
    <!-- <div class="container jumbotron"><?=$user?></div> -->
</div>
<!-- Main[End] -->
<script src="js/read.js" type="text/javascript"></script>
</body>
</html>