<?php
//headerとしてほぼ全ての表示されるページでしよう
//「前のページが自分のサーバーであるかどうか」
//「セッションユーザーがちゃんとあるか」を検証して弾いてる。
//つまりログインしてない人が直接URLクリックしても入れない
//たった７行。

$maePage = $_SERVER['HTTP_REFERER'];
$host = $_SERVER['HTTP_HOST'];
session_start();
$login_user = $_SESSION['login_user'];
if ($login_user==null or strpos($maePage, $host)===false) {
    header('Location: /php2');
}

?>

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="frontpage.php">カラオケ点数登録Revolution</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">カラオケ点数登録 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="read.php">みんなの点数</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user_mypage.php">マイページ</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="my_post.php">自分の投稿を見る</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php">ログアウト</a>
      </li>
    </ul>
  </div>
</nav>
</header>
