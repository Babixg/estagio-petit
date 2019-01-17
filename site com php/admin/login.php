<?php 
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Petit Poti | Login</title>

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
	<body style="background: rgb(246,246,246);">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-4">
					<div class="bloco" id="login">
						<h3>Login</h3>
						<form action="DALUsuario.php?act=login" method="POST">
							<div class="form-group row">
								<label for="inputEmail" class="col-12 col-form-label" id="lEmail">Email</label>
							    <div class="col-12">
							      <input value="" type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
							    </div>
							</div>
							<div class="form-group row">
								<label for="inputSenha" class="col-12 col-form-label" id="lSenha">Senha</label>
							    <div class="col-12">
							      <input value="" type="password" name="senha" class="form-control" id="inputSenha" placeholder="Senha">
							    </div>
							</div>
							<div class="row justify-content-center">
								<div class="col">
									<button type="submit" class="btn" id="btn-entrar"> Entrar </button>
								</div>
							</div> 
							<div class="row justify-content-center">
							<?php 
								if(isset($_SESSION['msg_login'])){
									echo $_SESSION['msg_login'];
									unset($_SESSION['msg_login']);
								}
							?>
							</div> 
							<div class="row justify-content-center">
								<div class="col">
									<a id="btn-cadastrar" href="" class="btn">Cadastre-se</a>
								</div>
							</div> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>