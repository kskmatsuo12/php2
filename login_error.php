<!-- パスワードが違ってたときに少しだけ表示するファイル -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログインエラー</title>
</head>
<body>
    <h1>パスワード違います！</h1>
    <script>
    
    setTimeout(function(){
        console.log('a');
        location.href = '/php2';
    },3000)
    
    </script>
</body>
<style>
    h1{
        color: red;
        text-align: center;
        margin-top:300px;
    }
</style>
</html>
