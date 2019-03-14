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
		<title>Itens</title>
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
						<h1 class="tit-secao"> Itens </h1>
						<button id="novo-item" onclick="window.location.href='novo-item.php'" type="button" class="btn-verde"> Novo Item </button>
					</div>
					<div class="col-lg-12 col-sm-12" id="dash-itens">
						<?php
							try {		 
							    $stmt = $conexao->prepare("SELECT * FROM itens");
							 
							        if ($stmt->execute()) {
							            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
							                echo "<div class='item col-lg-3 col-sm-12'>";
							                	echo "<div> <h1 class='item-nome'>" .$rs->nome. "</h1> </div>";
							                	echo "<div> <a href=\"editar-item.php?act=sel&btn_act=upd&id=".$rs->id_item."\"><i class='fas fa-pen'></i></a> <a href=\"?act=del&id=".$rs->id_item."\"><i class='fas fa-trash-alt'></i></a> </div>";
								            echo "</div>";
							            }
							        } else {
							            echo "Erro: Não foi possível recuperar os dados do banco de dados";
							        }
							} catch (PDOException $erro) {
							    echo "Erro: ".$erro->getMessage();
							}
						?>
						</div>
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