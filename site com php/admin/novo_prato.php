<?php
	error_reporting(0); //não ficar agoniando do session
	session_start();
	if(!isset($_SESSION["usuario_logado"]))
		header("Location: login.php");

	require_once("DALPrato.php");	
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Petit Poti | Novo Prato</title>

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
		<?php 
			if(isset($_SESSION["msg_prato"])){
				echo $_SESSION["msg_prato"];
				unset($_SESSION["msg_prato"]);
				
			}
		?>
		<script type="text/javascript">
			function Limpar(){
				document.querySelector("#btn-salvar").value = "save";
				document.getElementById('inputId').disabled = true;
				document.getElementById('inputId').value = "";
				document.getElementById('inputNome').value = "";
				document.getElementById('inputPeso').value = "";
				document.getElementById('inputingredientes').value = "";
				document.getElementById('inputdescricao').value = "";
				document.getElementById("inputCategoria").value = "";

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
							<h1 class="me"> Novo Prato </h1>
						</div> 
					</div>

					<!--Blocos-->
					<div class="row">
						<!--Lista-->						

						<div class="col-6">
							<!--Editar-->
							<div class="bloco" id="bl-editar">	
								<div>
									<form id="formulario" action="DALPrato.php" method="POST" name="form1">
										<br>
										<div class="form-group row">
											<label for="inputText" class="col-3 col-form-label" id="lNome">Nome</label>
										    <div class="col-9">
												<input type="hidden" class="form-control" name="id" id="inputId" placeholder="Id"
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
											<label for="inputPeso" class="col-3 col-form-label" id="lPeso">Peso</label>
										    <div class="col-9">
										      	<input type="text" class="form-control" name="peso" id="inputPeso" placeholder="Peso (em gramas)"
											      	<?php
									                	if (isset($peso) && $peso != null || $peso != "") {
									                    	echo "value=\"{$peso}\"";
									                	}
								                	?> 
								                >	
										    </div>
										</div>

										<div class="form-group row">
											<label for="inputdescricao" class="col-3 col-form-label" id="lidescrição">descrição</label>
											<div class="col-9">
											<input type="text"  class="form-control" placeholder="descrição" id="inputdescricao" name="descricao" 
													<?php if (isset($descricao) && $descricao != null || $descricao != "") { echo "value=\"{$descricao}\"";}?> 

											>		
											</div>
										</div>
										
										<div class="form-group row">
											<label for="inputingredientes" class="col-3 col-form-label" id="lingredientes">ingredientes</label>
											<div class="col-9">
											<input type="text"  class="form-control" placeholder="ingredientes" id="inputingredientes" name="ingredientes" 
													<?php if (isset($ingredientes) && $ingredientes != null || $ingredientes != "") { echo "value=\"{$ingredientes}\"";}?> 

											>		
											</div>
										</div>

										<div class="form-group row">
											<label for="inputCategoria" class="col-3 col-form-label" id="lPeso">Categoria</label>
										    <div class="col-9">
												<select name="tipo" id="inputCategoria">
													<option selected disabled value="">-- Selecione a categoria --</option>
													<option value="">Sem Categoria</option>
													<?php
														require_once("DALCategoria.php");
														try {		 
															$stmt = $conexao->prepare("SELECT * FROM categoria");
																if ($stmt->execute()) {
																	while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
																		if ($tipo == $rs->id_categoria) {
																			echo "<option selected value='" . $rs->id_categoria . "'>" . $rs->nome . "</option>";
																		}
																		else{
																			echo "<option value='" . $rs->id_categoria . "'>" . $rs->nome . "</option>";
																		}
																	}
																} else {
																	echo "Erro: Não foi possível recuperar os dados do banco de dados";
																}
														} catch (PDOException $erro) {
															echo "Erro: ".$erro->getMessage();
														}
													?>
												</select>
										    </div>
										</div>
										<div class="row justify-content-end">
											<div class="col-3">
												<button type="button" class="btn" id="btn-cancelar" onclick="Limpar()" style="background-color: #e01f1f;" Onclick="
													document.location.href='home.php'"> Cancelar </button>
											</div>
											<div class="col-3">
												<button name="act" type="submit" class="btn" value="upd" id="btn-salvar"> Salvar </button>
											</div>
										</div> 
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>