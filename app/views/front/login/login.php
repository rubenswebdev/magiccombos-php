<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>MagicCombos Administrativo</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= get_url('public/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= get_url('public/css/login.css')?>" rel="stylesheet">
    <link href="<?= get_url('public/css/mana-symbols.css')?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="<?=get_url('login')?>" role="form">
        <h2 class="form-signin-heading">Efetue Login</h2>
        <input type="text" class="form-control" placeholder="Login" name="login" required autofocus>
        <input type="password" class="form-control" placeholder="Senha" name="senha" required>
       
        <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
        <?=@$erro?>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
