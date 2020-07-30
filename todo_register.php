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
    left: 574px;
    top: 187px;
    color: rebeccapurple;
">
    <p style="
    margin: -12px -11px -5px 0;
    font-size: 13px;
    font-weight: bolder;
">ユーザー新規登録</p>
    <h1 style="
    font-size: 81px;
    margin: 0px 0px;
    font-family: 'Galada', cursive;
    ">Peeeece!</h1>
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