
<?php
//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=karaoke;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
    exit('DB Connection Error'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM music";

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
        $artist .= $r['artist_name'];
        // $obj = ["music_name" => $r['music_name'], "artist_name" => $r['artist_name']];
        // $music_name .= "<option value=".$obj.">".$r["music_name"]."</option>";
        $music_name .= "<option name='".$r['id']."'value=".$r['music_name'].">".$r["music_name"]."</option>";
        $artist_name .= "<option name='".$r['id']."'value=".$r['artist_name'].">".$r["artist_name"]."</option>";

        // $view .= "<tr><td>".$r["id"]."</td><td>".$r["name"]."</td></tr>";
        // $view .= "<tbody><tr><td scope='row'>".$r['indate']."</td><td>".$r['user']."</td><td>".$r['title']."</td><td>".$r['artist']."</td><td>".$r['innumber']."</td><td>".$r['comment']."</td></tr></tbody>";
    }
};

?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>カラオケ点数登録アプリ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
  <!-- <?= include('header.php'); ?> -->

    <h1>カラオケの点数を登録しよう！！！</h1>
    <a href="read.php">みんなの点数を見る</a>
  
    <!-- ユーザー名は最初のページからもってくる（時間ないからやめる。消さないようにする） -->
    <span>ユーザー名:</span> 
    <input type="text" id="user" name="user">
    

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
          <option id="music_select" selected value="norequire">曲を選ぶ</option>
          <?= $music_name ?>
        </select>
      </div>
      <!-- 歌手選択部分 -->
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">歌手</span>
        <select id="artist_add" type="text" name="artist" class="custom-select">
          <option id="artist_select" selected value="norequire">歌手を選ぶ</option>  
          <?= $artist_name ?>
        </select>
        <!-- <input id="artist_name" value=""> -->
      </div>
    </div>
    
    <!-- 点数選択 -->
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <select name="innumber" id="number" class="custom-select">
          <option id="number_select" selected value="norequire">点数</option>
        </select>
        <span class="text-danger">70点未満は心のどこかにしまっておきましょう</span>
      </div>
    </div>

    <!-- コメント欄 -->
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">コメント</span>
      </div>
      <input id="comment" name="comment" placeholder="何か一言あれば(なしでもok）" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <!-- <input type="submit" value="送信"> -->
 
  <!-- </form> -->
    <button id="send">送信</button>
  </div><!-- container閉じ   -->
<script>

for (var i = 0; i < 300 ; i++) {
    let j = (0.1*i);
    $('#number').append('<option value="' + (1000-j) + '">' + (100-j) + '</option>');
 };



</script>
<script src="js/index.js" type="text/javascript"></script>
</body>

<style>
h1 {
  text-align: center;
  margin-top: 50px;
  margin-bottom: 100px;
}

button {
  margin-top: 16px;
  margin-bottom: 16px;
}

</style>
</html>