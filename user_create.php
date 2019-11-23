<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
       <h1>ユーザ情報を登録してください！</h1>
       <form action="get_user_create.php" method="post">
       <!-- 名前 -->
       <div class="input-group mb-3">
         <div class="input-group-prepend">
             <span class="input-group-text" id="basic-addon1">名前</span>
         </div>
         <input name="user_name" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <!-- パスワード -->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">パスワード</span>
          </div>
          <input name="user_password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
        </div>
        <!-- 得意曲 -->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">得意曲</span>
          </div>
          <input name="user_favorite_music" type="text" class="form-control" placeholder="Favorite Song" aria-label="Favorite Song" aria-describedby="basic-addon1">
        </div>
        <!-- 登録ボタン -->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
           <span>登録しますか？</span>
          </div>
          <input type="submit" class="form-control" value="ユーザー登録する" aria-describedby="basic-addon1">
        </div>
        </form>
        
    </div>
</body>
</html>