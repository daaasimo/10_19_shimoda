<script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
<script>
  $(document).ready(function() {
    var formInputs = $('input[type="text"],input[type="password"]');
    formInputs.focus(function() {
      $(this).parent().children('p.formLabel').addClass('formTop');
      $('div#formWrapper').addClass('darken-bg');
      $('div.logo').addClass('logo-active');
    });
    formInputs.focusout(function() {
      if ($.trim($(this).val()).length == 0) {
        $(this).parent().children('p.formLabel').removeClass('formTop');
      }
      $('div#formWrapper').removeClass('darken-bg');
      $('div.logo').removeClass('logo-active');
    });
    $('p.formLabel').click(function() {
      $(this).parent().children('.form-style').focus();
    });
  });
</script>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/page1.css">
  <link href="https://fonts.googleapis.com/css2?family=Galada&display=swap" rel="stylesheet">
  <title>Document</title>

</head>

<body>
  <div style="
    position: absolute;
    font: color;
    color: black;
    top: 21%;
    left: 45%;
    z-index: 20;
    text-align: center;
    /* margin: 49px; */
    left: 605px;
    top: 167px;
    color: rebeccapurple;
    line-height: 1.4;
">

    <p style="
    margin: -12px -11px -5px 0;
    font-size: 13px;
    font-weight: bolder;
    /* position: absolute; */
">ユーザー新規登録</p>

    <h1 style="
    font-size: 81px;
    margin: 0px 0px;
    font-family: 'Galada', cursive;
    /* position: absolute; */
    left: -23%;
    /* display: flex; */
    left: -243%;
    top: 32%;
    ">Sorry</h1>
  </div>

  <div id="formWrapper" class="" style="
    background-color: rgba(0,0,0,0.7);
">
    <div id="form">
      <div class="logo">
      </div>

      <form action="todo_register_act.php" method="POST" style="
    /* top: 17%; */
    margin: 153px 24px 100px;
">
        <div class="form-item">
          <p class="formLabel formTop">username</p>
          <input type="text" name="username" id="username" class="form-style" autocomplete="off">
        </div>
        <div class="form-item">
          <p class="formLabel formTop">Password</p>
          <input type="password" name="password" id="password" class="form-style" autocomplete="off">
          <!-- <div class="pw-view"><i class="fa fa-eye"></i></div> -->

        </div>
        <div class="form-item">
          <p class="pull-left"> <a href="todo_login.php"><small>Cancel</small></a>
          </p>
          <input type="submit" class="login pull-right" value="Register">
          <div class="clear-fix"></div>
        </div>
      </form>
    </div>
  </div>
  <div id="form">
    <div class="logo">
    </div>

    <form action="todo_register_act.php" method="POST" style="
    /* top: 17%; */
    margin: 153px 24px 100px;
">
      <div class="form-item">
        <p class="formLabel formTop">username</p>
        <input type="text" name="username" id="username" class="form-style" autocomplete="off">
      </div>
      <div class="form-item">
        <p class="formLabel formTop">Password</p>
        <input type="password" name="password" id="password" class="form-style" autocomplete="off">
        <!-- <div class="pw-view"><i class="fa fa-eye"></i></div> -->

      </div>
      <div class="form-item">
        <p class="pull-left"> <a href="todo_login.php"><small>Cancel</small></a>
        </p>
        <input type="submit" class="login pull-right" value="Register">
        <div class="clear-fix"></div>
      </div>
    </form>
  </div>
  </div>
</body>

</html>

<?php
// var_dump($_POST);
// exit();

// 関数ファイル読み込み
include('functions.php');

// データ受け取り
$username = $_POST["username"];
$password = $_POST["password"];

// DB接続関数
$pdo = connect_to_db();

// ユーザ存在有無確認
$sql = 'SELECT COUNT(*) FROM users_table WHERE username=:username';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}

if ($stmt->fetchColumn() > 0) {
  // usernameが1件以上該当した場合はエラーを表示して元のページに戻る
  // $count = $stmt->fetchColumn();
  echo '<p style="
    position: absolute;
    top: 37%;
    right: 38.5%;
    font-size: small;
    background: red;
    color: white;
    padding: 6px 37px;
">すでに登録されているユーザです。</p>';
  echo '<a href="todo_login.php" class="login pull-right">Log in</a>';
  exit();
}

// ユーザ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, created_at, updated_at) VALUES(NULL, :username, :password, 0, 0, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:todo_login.php");
  exit();
}
