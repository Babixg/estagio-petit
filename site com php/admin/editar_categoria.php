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
		<title>Petit Poti</title>

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
		<script type="text/javascript">
			function Limpar(){
				document.querySelector("#btn-limpar").value = "limpar";
				document.getElementById('inputNome').value = "";
				document.getElementById('inputDescricao').value = "";	
				document.getElementById('inputId').value = "";	
			}
			function getParameterByName(name, url) {
				if (!url) url = window.location.href;
				name = name.replace(/[\[\]]/g, '\\$&');
				var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
					results = regex.exec(url);
				if (!results) return null;
				if (!results[2]) return '';
				return decodeURIComponent(results[2].replace(/\+/g, ' '));
			}
			function Update(){
				let x = getParameterByName("btn_act", window.location.href);
				if(x != null){
					document.querySelector("#btn-salvar").value = x;
				}
				else{
					document.querySelector("#btn-salvar").value = "save";
				}
			}

			window.addEventListener("load", Update);
		</script>
		<div class="container-fluid">
			<?php 
				if(isset($_SESSION["msg_categoria"])){
					echo $_SESSION["msg_categoria"];
					unset($_SESSION["msg_categoria"]);
				}
			?>
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
						    <a class="nav-link" href="#" >Menuzinho</a>
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
							<button type="button" class="btn btn-naveg me" style="background-color: #b6d201;"> Categorias </button>
							<button type="button" class="btn btn-naveg"> Pratos </button>
						</div>
					</div>

					<!--Blocos-->
					<div class="row justify-content-end">
						<!--Editar-->
						<div class="col-6">		
							<h3 class="me"> Editar </h3>
							<div class="bloco me" id="bl-editar">
								<div>
									<form action="DALCategoria.php"" method="POST">
										<br>
										<div class="form-group row">
											<label for="inputNome" class="col-3 col-form-label" id="lNome">Nome</label>
										    <div class="col-9">
												<input type="hidden" class="form-control" name="id" id="inputId"
													<?php
										                if (isset($id) && $id != null || $id != "") {
										                    echo "value=\"{$id}\"";
														}
									                ?>
										    	>
										    	<input type="text" class="form-control" name="nome" id="inputNome" placeholder="Nome"
													<?php
										                if (isset($nome) && $nome != null || $nome != "") {
										                    echo "value=\"{$nome}\"";
														}
									                ?>
										    	>
										    </div>
										</div>
										<div class="form-group row">
											<label for="inputDescricao" class="col-3 col-form-label" id="lDescricao">Descrição</label>
											<div class="col-9">
											<input type="text"  class="form-control" placeholder="Descrição" id="inputDescricao" name="descricao" <?php if (isset($descricao) && $descricao != null || $descricao != "") { echo "value=\"{$descricao}\"";}?> >	
											</div>
										</div>
																		
										<div class="row justify-content-end">
											<div class="col-2">
												<button type="button" class="btn" id="btn-limpar" onclick="Limpar()"> Limpar </button>
											</div>
											<div class="col-3">
												<button type="button" class="btn" id="btn-cancelar"> Cancelar </button>
											</div>
											<div class="col-3">
												<button type="submit" name="act" class="btn" id="btn-salvar" value="upd"> Salvar </button>
											</div>
										</div> 
									</form>
								</div>
							</div>
						</div>

						<!--Pratos existentes-->
						<div class="col-6">
							<h3 class="me"> Pratos de <?php if (isset($nome) && $nome != null || $nome != "") {
								echo "{$nome}";}?> </h3>
							<div class="bloco me">
								<form action="DALPrato.php?act=upd_tipo_prato&tipo_upd_p=null" method="POST">
									<?php
										$id_categoria = $_GET["id"];
										try {		 
											$stmt = $conexao->prepare("SELECT prato.nome, prato.id_prato FROM prato inner join categoria CAT on tipo = CAT.id_categoria where CAT.id_categoria = :id_categoria");
											$stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_INT);
											
											if ($stmt->execute()) {       
												while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
													echo "<div class='item-lista'>";
														echo "<div class='row'>";
															echo "<div class='col-9 align-self-center'>".$rs->nome."</div>";	
															echo "<div class='col-3 align-self-center'><button name='id_upd_p' value='".$rs->id_prato."'><i class='fas fa-trash-alt'></i></button></div>";
														echo "</div>";
													echo "</div>";
												}
												echo "</div>";      
											} else {
												echo "Erro: Não foi possível recuperar os dados do banco de dados";
											}
										} catch (PDOException $erro) {
											echo "Erro: ".$erro->getMessage();
										}
									?>
								</form>
							</div>
						</div>

						<div class="row justify-content-end" style="margin-top: -2vh;">
							<!--Adicionar pratos-->
							<div class="col-6">
								<h3 class="me"> Adicionar pratos </h3>
								<div class="bloco me">
									<form action="DALPrato.php?act=upd_tipo_prato&tipo_upd_p=<?php echo $_GET["id"] ?>" method="POST">
										<?php
											try {		 
												$stmt = $conexao->prepare("SELECT nome, id_prato FROM prato where tipo is null");
												if ($stmt->execute()) {       
													while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
														echo "<div class='item-lista'>";
															echo "<div class='row'>";
																echo "<div class='col-9 align-self-center'>".$rs->nome."</div>";
																echo "<div class='col-3 align-self-center'><button name='id_upd_p' value='".$rs->id_prato."'><i class='fas fa-star'></i></button></div>";
															echo "</div>";
														echo "</div>";
													}
													echo "</div>";      
												} else {
													echo "Erro: Não foi possível recuperar os dados do banco de dados";
												}
											} catch (PDOException $erro) {
												echo "Erro: ".$erro->getMessage();
											}
										?>
									</form>
								</div>
							</div>
						</div>			
					</div>
				</div>
			</div>
		</div>

		<script>
			//informar que não há elementos
			const mensagem = "<div class='alert alert-info'> <strong>Não há elementos !</strong> </div>";
			document.querySelectorAll(".form-pratos").forEach(function(el){
				if(el.children.length == 0)
					el.innerHTML = mensagem;
			});
		</script>
	</body>
</html>

						