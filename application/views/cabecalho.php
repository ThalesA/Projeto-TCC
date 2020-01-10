<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<titulo><?= @$titulo ?></titulo>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?= base_url("css/bootstrap.css") ?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url("css/estilo.css") ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url("css/jquery.dataTables.min.css") ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url("css/font-awesome.css") ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url("css/font-awesome.min.css") ?>">
        <script src="<?= base_url("js/jquery-3.4.1.min.js") ?>"></script>
	
	</head>
	<body>
		<?php if($this->session->userdata("usuario_logado")) : ?>
		<header><!--inicio cabecalho-->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">

            <button class="navbar-toggler" data-toggle="collapse" data-target="#nav-principal">
              <span class="navbar-toggler-icon"></span>
            </button>
            
            <?php if($this->session->userdata("perfil_usuario")) : ?>
                <div class="collapse navbar-collapse" id="nav-principal">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?php print base_url('index.php/usuario/principal') ?>" class="nav-link home1">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="<?php print base_url('index.php/reserva/reservar') ?>" class="nav-link home"><i class="fa fa-pencil-square-o"></i>Fazer reserva</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php print base_url('index.php/acesso/alterar') ?>" class="nav-link home"><i class="fa fa-user"></i>Alterar senha</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php print base_url('index.php/taxa/emitir') ?>" 
                       target="_blank" class="nav-link home"><i class="fa fa-file-archive-o"></i>Emitir taxa</a>
                    </li>
                    <li class="logout">
                      <?= anchor('acesso/logout', '<i class="ace-icon fa fa-power-off"></i>', array("class" => "sair"))?>
                    </li>
                  </ul>
                </div>
            <?php else : ?>
            <div class="collapse navbar-collapse" id="nav-principal">
              <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?php print base_url('index.php/usuario/principal') ?>" class="nav-link home"><i class="fa fa-exchange"></i>Controle de acesso</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle home" 
                    data-toggle="dropdown"><i class="fa fa-desktop"></i>Cadastros</a>

                    <div class="dropdown-menu">
                        <a href="<?php print base_url('index.php/usuario/morador') ?>" class="dropdown-item">Morador</a>
                        <a href="<?php print base_url('index.php/usuario/funcionario') ?>" class="dropdown-item">Funcionário</a>
                        <a href="<?php print base_url('index.php/tipo_reserva/reserva') ?>" class="dropdown-item">Tipo reserva</a>
                        <a href="<?php print base_url('index.php/multa/tipoMulta') ?>" class="dropdown-item">Tipo multa</a>
                    </div>

                </li>
                <li class="nav-item">
                    <a href="<?php print base_url('index.php/usuario/lista') ?>" class="nav-link home"><i class="fa fa-list" aria-hidden="true"></i>Lista moradores</a>
                </li>
                <li class="logout">
                  <?= anchor('acesso/logout', '<i class="ace-icon fa fa-power-off"></i>', array("class" => "sair"))?>
                </li>
              </ul>
            </div>
            <?php endif ?>
        </nav>
      </header><!--fim cabecalho-->
      
		<?php endif ?>
		<div class="container">
			<?php if($this->session->flashdata("success")) : ?>
				<p class="alert alert-success mt-3"><?= $this->session->flashdata("success") ?></p>
			<?php endif ?>
			<?php if($this->session->flashdata("danger")) : ?>
				<p class="alert alert-danger mt-3"><?= $this->session->flashdata("danger") ?></p>
			<?php endif ?>