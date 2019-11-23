<?php
//マイページで表示されるやつ
//ユーザーテーブルからセッションユーザーと同じユーザー名を取得して
//最初からvalueに入れておいて、idと一緒に更新用のchange_user.phpに飛ばす

include('session.php');

try {
    $pdo = new PDO('mysql:dbname=karaoke;charset=utf8;host=localhost', 'root', 'root');

    // $pdo = new PDO('mysql:dbname=ksk-tennis_karaoke;charset=utf8;host=mysql743.db.sakura.ne.jp', 'ksk-tennis', 'yukitiindb11');
} catch (PDOException $e) {
    exit('DB Connection Error'.$e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM user WHERE username=:login_user";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':login_user', $login_user, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行
//３．データ表示
// $view="";

if ($status==false) {
    $error = $stmt->errorInfo();
    exit("SQL Error:".$error[2]);
} else {
    $r = $stmt->fetch();
    $userpassword = $r["userpassword"];
    $id = $r["id"];
};

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>マイページ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
<?php include('header.php') ?>
    <div class="container text-center">
        <div class="userpage">
            <button class="btn btn-primary" type="button" onClick="history.back()">戻る</button>
            <h1>マイページ</h1>
            <p>ユーザー名：<?= $r["username"]?></p>
            <p>好きな曲：<?= $r["favorite"] ?></p>
        </div>
        <div class="profile">
            <h2>ユーザー情報の変更</h2>
            <form method="post" action="change_user.php">
            <p>変更後の：<input id="change_name" name="change_name" placeholder="名前の変更"></p>
            <p>変更後の好きな曲：<input id="change_favorite" name="change_favorite" placeholder="好きな曲の変更"></p>
            <input value="<?= $id ?>" type="hidden" name="change_id">
            <button class="btn btn-primary" type="submit" id="change">変更する</button>
            </form>
        </div>
    </div>
    
    <script type="text/javascript">

    $("#change").on("click",function(){
     let UserInput = prompt("パスワードを入力して下さい:","");
     console.log("test");
     let password = "<?php echo $userpassword; ?>";
     console.log(password);
     if(UserInput == password){
        console.log("good")
     } else {
        alert("パスワードが間違っています")
     }
    });

    </script>
</body>
</html>



<style>
    h1{
        text-align: center;
        margin-top: 50px;
        margin-bottom: 50px;
    }

    h2{
        margin-top: 50px;
    }

    .text-center {
        margin-top:50px;
        text-align: center;
    }
</style>