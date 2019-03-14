<?php 
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Login</title>
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
	<body style="background: rgb(246,246,246);">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-lg-4 col-sm-12">
					<div id="login">
						<h3>Login</h3>
						<form action="DALUsuario.php?act=login" method="POST">
							<div class="form-group row">
								<label for="login" class="col-sm-12 col-form-label">Login</label>
							    <div class="col-sm-12">
							      	<input required type="text" class="form-control" name="login">
							    </div>
							</div>
							<div class="form-group row">
								<label for="inputSenha" class="col-12 col-form-label" id="lSenha">Senha</label>
							    <div class="col-12">
							      <input required type="password" name="senha" class="form-control" id="inputSenha">
							    </div>
							</div>
							<div class="row justify-content-end">
								<button type="submit" class="btn-verde" style="width: 100px;"> Entrar </button>
							</div> 
							<div class="row justify-content-center">
							<?php 
								if(isset($_SESSION['msg_login'])){
									echo $_SESSION['msg_login'];
									unset($_SESSION['msg_login']);
								}
							?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>