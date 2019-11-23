<?php

//一覧から編集をクリックすると飛んでくるページ。


$id = $_GET["id"];
$user = $_GET["user"];
$title = $_GET["title"];
$artist = $_GET["artist"];
$innumber = $_GET["innumber"];
$comment = $_GET["comment"];

session_start();
$login_user = $_SESSION['login_user'];

if ($user !== $login_user) {
    header('Location: /php2');
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>投稿の更新</title><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('header.php');?>
  <div class="container">
    <form method="post" name="form" action="update.php">
    <h1>投稿の更新</h1>
  
    <!-- ユーザー名は最初のページからもってくる（時間ないからやめる。消さないようにする） -->
    <span>ユーザー名:</span> 
    <input type="text" id="user" name="user_name" value="<?= $user ?>">
    <input type="hidden" value="<?= $id ?>" name="id">
    <!-- 曲の登録部分 -->
    <!-- Button trigger modal -->
    <div class="input-group mb-3">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        曲名・歌手名を登録する
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">曲のタイトルと歌手の登録画面</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                <input id="music_name" name="music_name" type="text" class="form-control" placeholder="曲を新規で入力する際はこちら！" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"><br/>
              </div>
              <div class="input-group mb-3">
                <input id="artist_name" name="artist_name" type="text" class="form-control" placeholder="歌手を新規で入力する際はこちら！" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">  
              </div>
              <div class="input-group mb-3">
                <button id="send_music" data-dismiss="modal" type="button" class="btn btn-primary">曲名・歌手名を登録する</button>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 絞り込み -->
    <div class="input-group mb-3">
      <span>曲名、絞り込み:</span>
      <input type="text" id="user_list_search_men">
    </div>
    <!-- 曲選択部分 -->
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">曲名</span>
        <select id="music_add" type="text" name=title class="custom-select">
          <option id="music_select" value="norequire">曲を選ぶ</option>
          <option id="music_select" selected value="<?= $title ?>"><?= $title ?></option>
          <?= $music_name ?>
        </select>
      </div>
      <!-- 歌手選択部分 -->
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">歌手</span>
        <select id="artist_add" type="text" name="artist" class="custom-select">
          <option id="artist_select" value="norequire">歌手を選ぶ</option>
          <option id="artist_select" selected value="<?= $artist ?>"><?= $artist ?></option>  
          <?= $artist_name ?>
        </select>
        <!-- <input id="artist_name" value=""> -->
      </div>
    </div>
    
    <!-- 点数選択 -->
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <select name="innumber" id="number" class="custom-select">
          <option id="number_select" selected value="<?= $innumber/10 ?>"><?= $innumber/10 ?></option>
        </select>
        <span class="text-danger">70点未満は心のどこかにしまっておきましょう</span>
      </div>
    </div>

    <!-- コメント欄 -->
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">コメント</span>
      </div>
      <input id="comment" value="<?= $comment ?>" name="comment" placeholder="何か一言あれば(なしでもok）" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <!-- <input type="submit" value="送信"> -->
 
    </form>
  <!-- </form> -->
  <button id="send">送信</button>
  </div><!-- container閉じ   -->
<script>

for (var i = 0; i < 300 ; i++) {
    let j = (0.1*i);
    $('#number').append('<option value="' + (1000-j) + '">' + (100-j) + '</option>');
 };

$("#send").on("click",function(){
    if (confirm("更新して良いですか？")) {
        document.form.submit();
    }else {
        console.log('a');
    }
});

</script>
</body>
</html>