<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Almoxarifado</title>

    <!-- Bootstrap -->
    <link href="<?php echo asset_url("css/bootstrap.min.css")?>" rel="stylesheet">

    <link href="<?php echo asset_url("css/style.css")?>"rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo asset_url("js/jquery.min.js")?>"></script>
    <script src="<?php echo asset_url("js/bootstrap.min.js")?>"></script>
    <script src="<?php echo asset_url("js/script.js")?>"></script>
    <script src="<?php echo asset_url("js/numeric.js")?>"></script>

    <script src="<?php echo asset_url("js/select2.js")?>"></script>
    <script src="<?php echo asset_url("js/select2_locale_pt-BR.js")?>"></script>
    <link rel="stylesheet" href="<?php echo asset_url("css/select2.css")?>">
    <link rel="stylesheet" href="<?php echo asset_url("css/select2-bootstrap.css")?>">

    <script src="<?php echo asset_url("js/bootstrap-datepicker.js")?>"></script>
    <link rel="stylesheet" href="<?php echo asset_url("css/datepicker.css")?>">
</head>

<body>
    <div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <header class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url("products");?>">Almoxarifado</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if($this->session->userdata('level') == 2) { ?>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Estoque<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo site_url("groups");?>">Grupos de produtos</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("providers");?>">Fornecedores</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("consumers");?>">Consumidores</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatórios<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo site_url("report/inout");?>">Movimentação por grupo</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($this->session->userdata('level') == 3) { ?>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administração<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo site_url("users");?>">Usuários</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo site_url("sess/logout");?>">Sair</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sobre<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a target="_blank" href="https://github.com/weslleih/almoxarifado"><span class="glyphicon glyphicon-globe"></span> Página</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <div class="slider">
	       <div class="line"></div>
            <div class="break dot1"></div>
            <div class="break dot2"></div>
            <div class="break dot3"></div>
        </div>
    </header>
    <div class="container">

