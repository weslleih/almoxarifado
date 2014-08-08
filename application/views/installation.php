<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="wesllei.h@gmail.com">
    <link rel="icon" href="../../favicon.ico">

    <!-- Bootstrap -->
    <link href="<?php echo asset_url("css/bootstrap.min.css")?>"rel="stylesheet">
    <title>Almoxarifado - Instalação</title>

    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        form {
            max-width: 430px;
            padding: 15px;
            margin: 0 auto;
        }
    </style>



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <?php if(!isset($databese_config)){?>
        <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url("installation") ?>">
        <?php if(isset($error)){?>
            <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
        <?php } ?>
           <div class="text-center"><h2 >Banco de dados</h2></div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Usuário</label>
                <div class="col-sm-9">
                    <input name="dbuser" type="text" class="form-control" id="inputEmail3" placeholder="Usuário do banco de dados" value="<?php echo set_value('dbuser'); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Senha</label>
                <div class="col-sm-9">
                    <input name="dbpass" type="text" class="form-control" id="inputPassword3" placeholder="Senha" value="<?php echo set_value('dbpass'); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">Nome</label>
                <div class="col-sm-9">
                    <input name="dbname" type="text" class="form-control" id="inputPassword3" placeholder="Nome do banco de dados" value="<?php echo set_value('dbname'); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-10">
                    <button type="submit" class="btn btn-default">Salvar</button>
                </div>
            </div>
        </form>
        <div>
            <?php }else{?>
            <div id="dbdata">
                <p>Não foi possível salvar o aquivos de configurações.</p>
                <p>Por favor, salve esse texto no arquivo <code>application/config/database.php</code> e depois clique em <button type="button" id="confirm" class="btn btn-default" data-url="<?php echo site_url("installation/confirm") ?>">Confirmar</button></p>
                <div id="confirm-susses"></div>
                <div class="highlight">
                    <pre>
<code class="html"><?php echo $databese_config; ?></code>
                    </pre>
                </div>
            </div>
           <?php }?>
        </div>
    </div>
    <script src="<?php echo asset_url("js/jquery.min.js")?>" ></script>
    <script src="<?php echo asset_url("js/bootstrap.min.js")?>" ></script>
    <script src="<?php echo asset_url("js/installation.js")?>" ></script>
</body>

</html>
