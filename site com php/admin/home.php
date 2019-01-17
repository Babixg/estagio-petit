<?php
	error_reporting(0); //não ficar agoniando do session
	session_start();
	if(!isset($_SESSION["usuario_logado"]))
		header("Location: login.php");

	require_once("DALCategoria.php");
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Petit Poti | Home</title>

		<style>
			<?php include '../assets/css/admin.css'; ?>
			<?php include '../assets/css/bootstrap.min.css'; ?>
		</style> 

		<!--Links-->
		<!--CSS  <link rel="stylesheet" href="../assets/css/admin.css">-->
		<!--CSS Bootstrap <link rel="stylesheet" href="../assets/css/bootstrap.min.css">-->
		<!--Fontes --> <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
		<!--Jquery--> <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<!--Ajax--> <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<!--Javascrip Bootstrap--> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!--Font Awesome--> <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<!--Nav Lateral-->
				<div class="col-2" id="nav-lateral">
					<!--Infos do Usuário-->
					<div id="usuario">
						<div class="circle align-self-center">
							<img src="../assets/img/nathalia.jpg">
						</div>
						<div id="usuario-nome" class="align-self-center" >
							<span>
								<?php 
									echo $_SESSION["usuario_logado"];
								?>
							</span>
							<span id="cargo"> Proprietária </span>
						</div>
					</div>
					<!--Menu-->	
					<ul class="nav nav-pills flex-column">
				  		<li class="nav-item">
					    	<a class="nav-link" href="home.php">Início</a>
					  	</li>
					  	<li class="nav-item">
						    <a class="nav-link" href="#">Menuzinho</a>
						</li>
					  	<li class="nav-item">
					    	<a class="nav-link" href="#">Nossos Cuidados</a>
					  	</li>
					  	<li class="nav-item">
					    	<a class="nav-link" href="#">Cursos</a>
					  	</li>
					  	<li class="nav-item">
					    	<a class="nav-link" href="#">Petit Bistrô</a>
					  	</li>
					  	<li class="nav-item">
					    	<a class="nav-link" href="#">Petit Café</a>
					  	</li>
					  	<li class="nav-item">
					    	<a class="nav-link" href="#">Petit Poti na Mídia</a>
					  	</li>
					  	<li class="nav-item">
					    	<a class="nav-link" href="#">Localização</a>
					  	</li>
					  	<li class="nav-item">
					    	<a class="nav-link" href="#">Contato</a>
					  	</li>
					</ul>				
				</div>

				<!--Dashboard-->
				<div class="col-10" id="dashboard">
					<!--Botões-->
					<form action="DALUsuario.php" method="POST" class="row justify-content-end">
						<div class="col-4" id="editar"> 
							<button type="submit" class="ops" id="editar"> Editar perfil </button>
							<button name="act" value="logout" type="submit" class="ops" id="sair"> Sair <i class="fas fa-angle-down"></i> </button>
						</div>
					</form>

					<!--Título da Página e Botões-->
					<div class="row">
						<div class="col-12">
							<h1 class="me"> Menuzinho </h1>
						</div> 
					</div>

					<!--Blocos-->
					<div class="row">
						<!--Pratos-->
						<div class="col-6">		
						<!--botão decorativo-->					
							<button type="button" class="btn btn-naveg me"> Pratos </button>
							<form action="DALPrato.php" method="POST" class="bloco me">
								<?php
									try {		 
									    $stmt = $conexao->prepare("SELECT * FROM prato");
									 
									        if ($stmt->execute()) {
									            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
									                echo "<div class='item-lista'>";
										                echo "<div class='row'>";
										                	echo "<div class='col-9 align-self-center'>".$rs->nome."</div>";
										                	echo "<div class='col-2 align-self-center'><a href=\"editar_prato.php?act=sel&btn_act=upd&id=".$rs->id_prato."\"><i class='fas fa-edit'></i></a></div>";
										                		
										                	echo "<div class='col-1 align-self-center'><a href=\"?act=del&id=".$rs->id_prato."\"><i class='fas fa-trash-alt'></i></a></div>";
										                echo "</div>";
										            echo "</div>";
									            }
									        } else {
									            echo "Erro: Não foi possível recuperar os dados do banco de dados";
									        }
									} catch (PDOException $erro) {
									    echo "Erro: ".$erro->getMessage();
									}
								?>
							</form>
							<div class="bloco d-flex align-content-center flex-wrap me">
								<button type="button" class="btn btn-criar align-self-center" Onclick="
								document.location.href='novo_prato.php'"> Novo Prato</button>
							</div>
						</div>
						<!--Categoria botão decorativo-->
						<div class="col-6">
							<button type="button" class="btn btn-naveg me" style="background-color: #b6d201;"> Categorias </button>	
							<form action="DALCategoria.php" method="POST" class="bloco me" >
								<?php
									try {		 
									    $stmt = $conexao->prepare("SELECT * FROM categoria");
									 
									        if ($stmt->execute()) {
									            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
									                echo "<div class='item-lista'>";
										                echo "<div class='row'>";
										                	echo "<div class='col-9 align-self-center'>".$rs->nome."</div>";
										                	echo "<div class='col-2 align-self-center'><a href=\"editar_categoria.php?act=sel&btn_act=upd&id=".$rs->id_categoria."\"><i class='fas fa-edit'></i></a></div>";
										                		
										                	echo "<div class='col-1 align-self-center'><a href=\"?act=del&id=".$rs->id_categoria."\"><i class='fas fa-trash-alt'></i></a></div>";
										                echo "</div>";
										            echo "</div>";
									            }
									        } else {
									            echo "Erro: Não foi possível recuperar os dados do banco de dados";
									        }
									} catch (PDOException $erro) {
									    echo "Erro: ".$erro->getMessage();
									}
								?>
							</form>
							<!--Butão-->
							<div class="bloco d-flex align-content-center flex-wrap me">
								<button type="button" class="btn btn-criar align-self-center" Onclick="
								document.location.href='novo_categoria.php'"> Nova Categoria</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>