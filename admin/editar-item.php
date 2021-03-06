<?php
	error_reporting(0); //não ficar agoniando do session
	session_start();
	if(!isset($_SESSION["usuario_logado"]))
		header("Location: login.php");

	require_once("DALItem.php");	
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Editar Item</title>
		<link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png"/>
		<!--Style-->
		<style>
			<?php include '../assets/css/admin.css' ?>
			<?php include '../assets/css/bootstrap.min.css' ?>
		</style>
		<!--Fonts-->
		<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	</head>
	<body>
		<?php 
			if(isset($_SESSION["msg_prato"])){
				echo $_SESSION["msg_prato"];
				unset($_SESSION["msg_prato"]);
			}
		?>
		<div class="row" id="superior" style="margin: 0;">
			<div class="col-2" id="menu-administrador">
				Menu Administrador
			</div>
		</div>
		<div class="row" style="margin: 0;">
			<div id="nav" class="col-lg-2">
				<div class="nav-item"> 
					<a href="itens.php">Itens</a> 
				</div>
				<div class="nav-item"> 
					<a href="categorias.php">Categoria</a>
				</div>
				<div class="nav-item"> 
					<a href="DALUsuario.php?act=logout">Sair</a> 
				</div>
			</div>
			<div id="dashboard" class="col-lg-10 col-sm-12">
				<div class="row">
					<div class="col-lg-12 col-sm-12">
						<h1 class="tit-secao"> Editar <?php if (isset($nome) && $nome != null || $nome != "") { echo $nome;} ?></h1>
					</div>
					<div class="col-lg-12 col-sm-12" id="form-adc">
						<form id="formulario" action="DALItem.php" method="POST" name="form1" enctype="multipart/form-data">
							<div class="row">
							<!--Português-->
								<div class="col-lg-4 col-sm-12">
									<!--Id-->
									<input type="hidden" class="form-control" name="id" id="inputId" placeholder="Id"
										<?php if (isset($id) && $id != null || $id != "") { echo "value=\"{$id}\"";} ?>>
									<!--Nome-->
									<div class="form-group row">
									    <label for="nome-pt" class="col-sm-2 col-form-label">Nome</label>
									    <div class="col-sm-10">
									      	<input required type="text" class="form-control" id="nome-pt" name="nome" maxlength="20"
									      	<?php if (isset($nome) && $nome != null || $nome != "") { echo "value=\"{$nome}\"";} ?>>
									    </div>
									</div>
									<!--Descrição-->
									<div class="form-group row">
									    <label for="descricao-pt" class="col-sm-12 col-form-label">Descrição</label>
									    <div class="col-sm-12">
									      	<textarea required class="form-control" id="descricao-pt" name="descricao" rows="3" maxlength="60"><?php if (isset($descricao) && $descricao != null || $descricao != "") { echo $descricao;}?></textarea>
									    </div>
									</div>
									<!--Ingredientes-->
									<div class="form-group row">
									    <label for="ingredientes-pt" class="col-sm-12 col-form-label">Ingredientes</label>
									    <div class="col-sm-12">
									      <textarea required class="form-control" id="ingredientes-pt" name="ingredientes" rows="3" maxlength="100"><?php if (isset($ingredientes) && $ingredientes != null || $ingredientes != "") { echo $ingredientes;}?> </textarea>
									    </div>
									</div>
								</div>

							<!--Inglês-->
								<div class="col-lg-4 col-sm-12">
									<!--Nome-->
									<div class="form-group row">
									    <label for="nome-en" class="col-sm-2 col-form-label">Name</label>
									    <div class="col-sm-10">
									      	<input required type="text" class="form-control" id="nome-en" name="name" maxlength="20"
									      	<?php if (isset($name) && $name != null || $name != "") { echo "value=\"{$name}\"";} ?>>
									    </div>
									</div>
									<!--Descrição-->
									<div class="form-group row">
									    <label for="descricao-en" class="col-sm-12 col-form-label">Description</label>
									    <div class="col-sm-12">
									      	<textarea required class="form-control" id="descricao-en" name="description" rows="3" maxlength="60"><?php if (isset($description) && $description != null || $description != "") { echo $description;}?></textarea>
									    </div>
									</div>
									<!--Ingredientes-->
									<div class="form-group row">
									    <label for="ingredientes-en" class="col-sm-12 col-form-label">Ingredients</label>
									    <div class="col-sm-12">
									      	<textarea required class="form-control" id="ingredientes-en" name="ingredients" rows="3" maxlength="100"><?php if (isset($ingredients) && $ingredients != null || $ingredients != "") { echo $ingredients;}?></textarea>
									    </div>
									</div>
								</div>

							<!--Espanhol-->
								<div class="col-lg-4 col-sm-12">
									<!--Nome-->
									<div class="form-group row">
									    <label for="nome-es" class="col-sm-3 col-form-label">Nombre</label>
									    <div class="col-sm-9">
									      	<input required type="text" class="form-control" id="nome-es" name="nombre" maxlength="20"
									      	<?php if (isset($nombre) && $nombre != null || $nombre != "") { echo "value=\"{$nombre}\"";} ?>>
									    </div>
									</div>
									<!--Descrição-->
									<div class="form-group row">
									    <label for="descricao-es" class="col-sm-12 col-form-label">Descripción</label>
									    <div class="col-sm-12">
									      	<textarea required class="form-control" id="descricao-es" name="descripcion" rows="3" maxlength="60"><?php if (isset($descripcion) && $descripcion != null || $descripcion != "") { echo $descripcion;}?></textarea>
									    </div>
									</div>
									<!--Ingredientes-->
									<div class="form-group row">
									    <label for="ingredientes-es" class="col-sm-12 col-form-label">Ingredientes (espanhol)</label>
									    <div class="col-sm-12">
									      	<textarea required class="form-control" id="ingredientes-es" name="ingredienteses" rows="3" maxlength="100"><?php if (isset($ingredienteses) && $ingredienteses != null || $ingredienteses != "") { echo $ingredienteses;}?></textarea>
									    </div>
									</div>
								</div>
							</div>

							<!--Imagem-->
							<div class="row">
								<div class="col-lg-1 col-sm-12">Imagem</div>
								<div class="col-lg-5 col-sm-12" style="overflow: hidden;"><input id="arquivo" name="arquivo" type="file"></div>
							</div>
							<div class="row justify-content-end">
								<button class="btn-verde" onclick="" style="background-color: #d14f08"> Cancelar </button>
								<button name="act" type="submit" value="upd" class="btn-verde"> Salvar </button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="responsive-nav">
				<div class="row">
					<div class="col resposive-nav-item">
						<a href="itens.php">
							<div><i class="fas fa-utensils"></i></div>
							<div><a href="itens.php">Itens</a></div>
						</a>
					</div>
					<div class="col resposive-nav-item">
						<a href="categorias.php">
							<div><i class="fas fa-list-alt"></i></div>
							<div><a href="categorias.php">Categoria</a></div>
						</a>
					</div>
					<div class="col resposive-nav-item">
						<a href="logout.php">
							<div><i class="fas fa-times"></i></div>
							<div><a href="DALUsuario.php?act=logout">Sair</a></div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>