<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap -->
    <link href="<?php echo asset_url("css/bootstrap.min.css")?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo asset_url("css/login.css")?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <form class="form-signin" role="form" action="<?php echo site_url("sess/login");?>" method="post">
            <h2 class="form-signin-heading">Almoxarifado</h2>
            <?php echo validation_errors(); ?>
            <input name="login" type="text" class="form-control" placeholder="login" required autofocus value="<?php echo set_value('login'); ?>">
            <input name="password" type="password" class="form-control" placeholder="senha" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
        </form>
    </div>
</body>

</html>
