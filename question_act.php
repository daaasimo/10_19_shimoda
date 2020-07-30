<script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
<script>
  $(document).ready(function() {
    var formInputs = $('input[type="text"]');
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
    left: 574px;
    top: 187px;
    color: rebeccapurple;
">
    <p style="
    margin: -12px -11px -5px 0;
    font-size: 13px;
    font-weight: bolder;
">ピタッとはまる出会いを。</p>
    <h1 style="
    font-size: 81px;
    margin: 0px 0px;
    font-family: 'Galada', cursive;
    line-height: 106px;
    ">Peeeece!</h1>
  </div>

  <div id="formWrapper">
    <div id="form">
      <div class="logo">
      </div>

      <form action="todo_login_act.php" method="POST" style="
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
          <p class="pull-left"> <a href="todo_register.php"><small>Register</small></a>
          </p>
          <input type="submit" class="login pull-right" value="Log In">
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
session_start();
// 外部ファイル読み込み
include("functions.php");
// DB接続します
$pdo = connect_to_db();
$username = $_POST["username"];
$password = $_POST["password"];

// データ取得SQL作成&実行
$sql = 'SELECT * FROM users_table WHERE username=:username AND password=:password AND is_deleted=0';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行時にエラーがある場合
if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}

// うまくいったらデータ（1レコード）を取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
  echo '<p style="
    position: absolute;
    top: 37%;
    right: 38.5%;
    font-size: small;
    background: red;
    color: white;
    padding: 6px 37px;
">ログイン情報に誤りがあります。</p>';
  exit();
} else {
  $_SESSION = array();
  $_SESSION["session_id"] = session_id();
  $_SESSION["is_admin"] = $val["is_admin"];
  $_SESSION["username"] = $val["username"];
  $_SESSION["id"] = $val["id"];
  header("Location: ../ひょっとこ/index2.php");
  exit();
}
