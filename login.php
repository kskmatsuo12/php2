<?php
//このページはindexから入ってこないと弾かれるようになっている
//一番最初のif文で弾いてる
//どうしてhostとhttpを定義するかは、桜サーバーでもローカルサーバーでも同じコードで済む

$host = $_SERVER['HTTP_HOST']; //host名を受信
$http = (empty($_SERVER["HTTPS"]) ? "http://" : "https://"); //https: or http

if ($_SERVER['HTTP_REFERER'] != $host + $http + 'php2') { //左で「前のページのURL」右で「URLを指定」これが一致すれば処理をするという意味。
    echo '失敗！';
} else {
    $login_user = $_POST["login_user"];
    $login_password = $_POST["login_password"];
    // echo $login_user;
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=karaoke;charset=utf8;host=localhost', 'root', 'root');
    
        // $pdo = new PDO('mysql:dbname=ksk-tennis_karaoke;charset=utf8;host=mysql743.db.sakura.ne.jp', 'ksk-tennis', 'yukitiindb11');
    } catch (PDOException $e) {
        exit('DB Error:'.$e->getMessage());
    }

    //３．デーz１タ登録SQL作成
    $sql = "SELECT * FROM user WHERE username=:login_user";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':login_user', $login_user, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $status = $stmt->execute(); //実行

//４．データ登録処理後
    if ($status==false) {
        echo 'ユーザーが存在しません';
        head('Location: /php2');
    } else {
        $r = $stmt->fetch();
        
        if ($login_password == $r["userpassword"]) {
            echo $login_user;
            session_start();
            $_SESSION['login_user'] = $login_user;
            header("Location: frontpage.php");
        } else {
            header('Location: login_error.php');
        }
        exit(); //終了のおまじない
    }
}
