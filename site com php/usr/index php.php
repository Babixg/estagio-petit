<?php
	require_once("../admin/DALCategoria.php");
	require_once("../admin/DALPrato.php");
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Petit Poti</title>
		<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png"/>
		<meta name="description" content="Comida de verdade.">
		<!--Script-->
		<script src="assets/vendors/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
		<script src="assets/js/index.js"></script>
		<script src="assets/owlcarousel/owl.carousel.js"></script>

		<!--Style-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/docs.theme.min.css">
		<link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="assets/css/index.css">

		<!--Fonts-->
		<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

		<style>
			.home-demo .item {
				background: white;
				display: flex;
				justify-content: center;
			}

			#btn-nav:hover, #btn-nav:focus {
				background-color: #bdd108;
			}
		</style>	
	</head>
	<body>
		<!--Nav-->
		<nav id="navzinha" class="nav navbar navbar-expand-lg" style="height: 50px;  position: fixed;">
			<a class="navbar-brand" href="#" style="margin-left: 2rem">
			    <img src="assets/img/logo.png" width="150" alt="Petit Poti">
			</a>

		  	<button id="btn-nav" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
		    	<i class="fas fa-bars" style="color: #24bec0;"></i>
		  	</button>

			<div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="navbar-nav" style="text-align: right;">
			      	<li><a class="nav-link" id="inicio-tab">Início</a></li>
					<li><a class="nav-link" id="menuzinho-tab">Menuzinho</a></li>
					<li><a class="nav-link" id="cuidado-tab" >Cuidado</a></li>
					<li><a class="nav-link" id="cursos-tab">Curso</a></li>
					<li><a class="nav-link" id="bistro-tab">Bistrô</a></li>
					<li><a class="nav-link" id="midia-tab">Mídia</a></li>
					<li><a class="nav-link" id="localizacao-tab">Localização</a></li>
					<li><a class="nav-link" id="contato-tab">Contato</a></li>
					<li><a class="nav-link" id="idioma-tab" data-toggle="modal" data-target="#modal-idiomas">Idioma</a></li>
			    </ul>
			</div>
		</nav>

		<!--Texto inicial e forma-->
		<div id="bg" style="background-image: url(assets/img/responsive-bg.png);">
			<div id="texto-inicial">
				<h1 style="color: #24bec0;"> Você tem tempo para fazer a <span style="color:#bdd108;">melhor comida </span> para seu bebê?</h1>
				<h3  style="color: #24bec0;"> Nós temos. </h3>
				<h3 style="margin-bottom: 0px; color: #dea900;">E preparamos tudo com muito amor e carinho sempre.</h3>
			</div>
		</div>

		<!--Slider-->
		<div id="slider" class="carousel slide" data-ride="carousel">
		  	<div class="carousel-inner">
		    	<div class="carousel-item active">
		      		<div class="slider-img" style="background-image: url(assets/img/produtos.jpg);" alt="Nossos produtos!"></div>
		   	 	</div>
			    <div class="carousel-item">
			    	<div class="slider-img" style="background-image: url(assets/img/cubinhos.jpg);" alt="Cubinhos Petit Poti!"></div>
			    </div>
			    <div class="carousel-item">
			    	<div class="slider-img" style="background-image: url(assets/img/sopinhas.jpg);" alt="Sopinhas deliciosas!"></div>
			    </div>
			    <div class="carousel-item">
			    	<div class="slider-img" style="background-image: url(assets/img/frutinhas.jpg);" alt="Frutinhas super saudáveis para seu bebê!"></div>
			    </div>
			    <div class="carousel-item">
			    	<div class="slider-img" style="background-image: url(assets/img/bolinhos.jpg);" alt="Os bolinhos mais gostosos!"></div>
				</div>
		  	</div>
		</div>

		<!--Modal-->
		<div class="modal fade" id="modal-idiomas">
			<div class="modal-dialog" style="background-image: url(assets/img/bg-modal.png);">
				<div class="modal-content" style="background-color: transparent; border: none;">
					<div class="row justify-content-end">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true" style="font-size: 36px; color: white;">&times;</span>
						</button>
					</div>
					<div class="row justify-content-center">
						<h4 class="modal-title">Escolha um idioma
						<h4 class="modal-title m" style="color: #f0f0f0">Choose your language <br></h4>
						<h4 class="modal-title m" style="color: #e1e1e1">Seleccione el idioma</h4>
					</div>
					<div class="row justify-content-center" style="margin-top: 30px;">
						<p class="modal-texto"> <a href="pt.html"> PT </a></p>
						<p class="modal-texto"> <a href="pt.html"> EN </a></p>
						<p class="modal-texto"> <a href="pt.html"> ES </a></p>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<section id="menuzinho" class="sec-site"> 
					<div class="home-demo">
						<div class="row">
						  	<div class="large-12 columns">
								<h1 class="titulo-h1"> Menuzinho </h1>
								<p class="texto-grande" style="color: #525252;"> Para crianças a partir de 6 meses </p>

								<!--Botões-->
								<div class="row justify-content-center" style="margin-bottom: 10px;">
									<form action="DALCategoria.php" method="POST">
										<?php
											try {		 
											    $stmt = $conexao->prepare("SELECT * FROM categoria");
											
											        if ($stmt->execute()) {   
											            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
										                	echo "<a class='btn-menuzinho azul' href=\"?act=filtro&id=".$rs->id_categoria."\">".$rs->nome."</a>";      
											            }

											        } else {
											            echo "Erro: Não foi possível recuperar os dados do banco de dados";
											        }

											} catch (PDOException $erro) {
											    echo "Erro: ".$erro->getMessage();
											}
										?>
									</form>
								</div>

								<!--Itens-->
								<div class="owl-carousel">
					  					
					  					<?php
					  						if(isset($_GET["act"]) && $_GET["act"] == "filtro" && isset($_GET["id"])){
												$id_categoria = $_GET["id"];
												try {		 
													$stmt = $conexao->prepare("SELECT prato.nome, prato.descricao, prato.ingredientes FROM prato inner join categoria CAT on tipo = CAT.id_categoria where CAT.id_categoria = :id_categoria");
													$stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_INT);
													
													if ($stmt->execute()) { 
														while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
															<div class='item'>
																<div class='m-item'>
																	<img src='assets/img/bolinhos.jpg'>;
																	<h5> <?php $rs->nome ?></h5>
																	<div class='m-item-text'>
																		<p class='item-desc'> <?php $rs->descricao ?> </p>
																		<p class='item-m-desc'> <?php $rs->ingredientes ?> </p>
																	</div>
																</div>
															</div>
													<?php	}

													} else {
														echo "Erro: Não foi possível recuperar os dados do banco de dados";
												}
												} catch (PDOException $erro) {
													echo "Erro: ".$erro->getMessage();
												}
											}
								      		else{
												try {		 
													$stmt = $conexao->prepare("SELECT * from prato");
													
													if ($stmt->execute()) { 
														while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
															<div class='item'>
																<div class='m-item'>
																	<img src='assets/img/bolinhos.jpg'>;
																	<h5> <?php $rs->nome ?></h5>
																	<div class='m-item-text'>
																		<p class='item-desc'> <?php $rs->descricao ?> </p>
																		<p class='item-m-desc'> <?php $rs->ingredientes ?> </p>
																	</div>
																</div>
															</div>
													<?php	}

													} else {
														echo "Erro: Não foi possível recuperar os dados do banco de dados";
													}
												} catch (PDOException $erro) {
													echo "Erro: ".$erro->getMessage();
												}
											}
										?>
									
								</div>
							   	
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>

		<!--Nosso Cuidado-->
		<div class="container">
			<div class="row">
				<section id="cuidado" class="sec-site flex">
					<div">
						<div class="col-12">
							<h1 class="titulo-h1">Nosso Cuidado</h1>
							<br> 
							<div class="row">
								<div class="col-sm-12 col-lg-4">
									<div> <img src="assets/img/planejamento.png"> </div>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
								</div>
								
								<div class="col-sm-12 col-lg-4">
									<div> <img src="assets/img/ingredientes.png"> </div>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
								</div>
								
								<div class="col-sm-12 col-lg-4">
									<div> <img src="assets/img/preparo.png"> </div>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
								</div>
							</div>
							<br> <br>
							<div class="row">
								<div class="col-sm-12 col-lg-4">
									<div> <img src="assets/img/refrigeramento.png"> </div>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
								</div>
								
								<div class="col-sm-12 col-lg-4">
									<div> <img src="assets/img/armazenamento.png"> </div>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
								</div>
								
								<div class="col-sm-12 col-lg-4">
									<div> <img src="assets/img/entrega.png"> </div>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
								</div>
							</div>
							<i class="fas fa-angle-down"></i>
						</div>
					</div>
				</section>
			</div>
		</div>

		<!--Introdução Alimentar-->
		<div class="container">
			<div class="row">
				<section id="curso" class="sec-site"> 
					<h1 class="titulo-h1"> Curso de Introdução Alimentar </h1>
					<br> 
					<div class="row justify-content-center flex" style="display: flex;">
						<div class="col-2"> </div>
						<div class="col-8">
							<p class="texto-grande">
								<span style="color:#bdd108;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit? Eget maximus volutpat, risus nisl pharetra sapien ac. </span>
							</p>
							<p class="texto-grande">
								Praesent sed augue ac magna euismod commodo vitae sed nulla. Nam sit amet eros facilisis. Pellentesque congue, nisl eget maximus volutpat, risus nisl pharetra sapien, ac volutpat est ligula eu erat. 
							</p>
							<p class="texto-grande">
								Praesent sed augue ac magna euismod commodo vitae sed nulla. Nam sit amet eros facilisis. Pellentesque congue, nisl eget maximus volutpat, risus nisl pharetra sapien, ac volutpat est ligula eu erat. 
							</p>
						</div>
						<div class="col-2"> </div>
					</div>

					<!--Imagens-->
					<div class="row justify-content-center">
						<div class="col-12 flex">
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">								
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">	
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">	
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">	
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">	
							</div>
						</div>
					</div>

					<i class="fas fa-angle-down"></i>
				</section>
			</div>
		</div>

		<!--Petit Bistrô-->
		<div class="container">
			<div class="row">
				<section id="bistro" class="sec-site"> 
					<h1 class="titulo-h1"> Petit Bistrô </h1>
					<br> 
					<div class="row justify-content-center flex">
						<div class="col-2"> </div>
						<div class="col-8">
							<p class="texto-grande">
								<span style="color:#bdd108;"> Lorem ipsum dolor sit amet, consectetur adipiscing elit? Eget maximus volutpat, risus nisl pharetra sapien ac. </span>
							</p>
							<p class="texto-grande">
								Praesent sed augue ac magna euismod commodo vitae sed nulla. Nam sit amet eros facilisis. Pellentesque congue, nisl eget maximus volutpat, risus nisl pharetra sapien, ac volutpat est ligula eu erat. 
							</p>
							<p class="texto-grande">
								Praesent sed augue ac magna euismod commodo vitae sed nulla. Nam sit amet eros facilisis. Pellentesque congue, nisl eget maximus volutpat, risus nisl pharetra sapien, ac volutpat est ligula eu erat. 
							</p>
						</div>
						<div class="col-2"> </div>
					</div>

					<!--Imagens-->
					<div class="row justify-content-center">
						<div class="col-12 flex" style="margin:0;">
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">								
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">	
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">	
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">	
							</div>
							<div class="col-sm-2 col-lg-2" style="padding: 0;">
								<img class="img-fluid" src="assets/img/sopinhas.jpg">	
							</div>
						</div>
					</div>

					<i class="fas fa-angle-down"></i>
				</section>
			</div>
		</div>

		<!--Petit na Mídia-->
		<div class="container">
			<div class="row">
				<section id="midia" class="sec-site"> 
					<h1 class="titulo-h1"> Petit na Mídia </h1>
					<br> 
					<div class="row justify-content-center flex">

							<div class="row">
								<div class="col video">
									<iframe width="240px" height="135px" 
										src="https://www.youtube.com/embed/tgbNymZ7vqY">
									</iframe>
									<p class="desc-video"> Lorem Ipsum </p>
								</div>
								<div class="col video">
									<iframe width="240px" height="135px" 
										src="https://www.youtube.com/embed/tgbNymZ7vqY">
									</iframe>
									<p class="desc-video"> Lorem Ipsum </p>
								</div>
								<div class="col video">
									<iframe width="240px" height="135px" 
										src="https://www.youtube.com/embed/tgbNymZ7vqY">
									</iframe>
									<p class="desc-video"> Lorem Ipsum </p>
								</div>
							</div>

							<div class="row">
								<div class="col video">
									<iframe width="240px" height="135px" 
										src="https://www.youtube.com/embed/tgbNymZ7vqY">
									</iframe>
									<p class="desc-video"> Lorem Ipsum </p>
								</div>
								<div class="col video">
									<iframe width="240px" height="135px" 
										src="https://www.youtube.com/embed/tgbNymZ7vqY">
									</iframe>
									<p class="desc-video"> Lorem Ipsum </p>
								</div>
								<div class="col video">
									<iframe width="240px" height="135px" 
										src="https://www.youtube.com/embed/tgbNymZ7vqY">
									</iframe>
									<p class="desc-video"> Lorem Ipsum </p>
								</div>
							</div>
						</div>
					<!-- SnapWidget -->
				</section>
			</div>
		</div>

		<!--Widget Instagram-->
		<iframe id="instagram-widget" src="https://snapwidget.com/embed/644832" class="snapwidget-widget" allowtransparency="true" frameborder="0" scrolling="no"></iframe>

		<!--Localização-->
		<div class="container">
			<div class="row">
				<section id="localizacao" class="sec-site"> 
					<h1 class="titulo-h1"> Localização </h1>
					<p class="texto-grande"> Venha nos conhecer! </p>
					<div class="row justify-content-center">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2806.790713069088!2d-35.20390238299861!3d-5.798832566642134!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3e49669816f040e3!2sPetit+Poti!5e0!3m2!1spt-BR!2sbr!4v1547164492627" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>

					<i class="fas fa-angle-down2"></i>
				</section>
			</div>
		</div>

		<!--Contato-->
		<div class="container" style="height: auto;">
			<div class="row justify-content-center">
				<section id="contato" class="sec-site"> 
					<h1 class="titulo-h1" style="margin: 0; margin-top: 50px;"> Contato </h1>
					<p class="texto-grande" style="color: #525252"> Ligue para nós! Temos delivery :D </p>
					<p class="texto-grande"> Aceitamos débito e crédito </p>

					<div class="row justify-content-center">
						<div class="col-sm-12 col-lg-4">
							<a href="tel:+55 84 3014-1414">
								<div class="btn-contato" style="background-color: #24bec0;">
									<div class="row">
										<div class="col-4">
											<div class="btn-contato-icone">
												<i class="fas fa-phone"></i>
											</div>
										</div>
										<div class="col-8">
											<p class="btn-contato-item"> Telefone </p>
											<p class="btn-contato-info"> (84) 3014-1414 </p>
										</div>
									</div>
								</div>
							</a>
						</div>

						<div class="col-sm-12 col-lg-4">
							<a href="https://api.whatsapp.com/send?phone=558481404440">
								<div class="btn-contato" style="background-color: #bdd108;">
									<div class="row">
										<div class="col-4">
											<div class="btn-contato-icone">
												<i class="fas fa-comment"></i>
											</div>
										</div>
										<div class="col-8">
											<p class="btn-contato-item"> Whatsapp </p>
											<p class="btn-contato-info"> (84) 98140-4400 </p>
										</div>
									</div>
								</div>
							</a>								
						</div>

						<div class="col-sm-12 col-lg-4">
							<a href="mailto:petitpoti@gmail.com">
								<div class="btn-contato" style="background-color: #dea900;">
									<div class="row">
										<div class="col-4">
											<div class="btn-contato-icone">
												<i class="fas fa-envelope"></i>
											</div>
										</div>
										<div class="col-8">
											<p class="btn-contato-item"> Email </p>
											<p class="btn-contato-info"> petitpoti@gmail.com </p>
										</div>
									</div>							
								</div>
							</a>
						</div>
					</div>
				</section>
			</div>
		</div>

		<!--Rodapé-->
		<div class="container" id="footer" style="padding: 0;">
			<section>
				<div id="sub-footer">
					Siga nas redes sociais    
					<span style="margin-left: 12px;">
						<a href="https://www.facebook.com/petitpoti"><i class="fab fa-facebook-square"></i></a>
					</span>
					<span style="margin-left: 6px;">
						<a href="https://www.instagram.com/petitpoti"><i class="fab fa-instagram"></i></a>
					</span>
				</div>
				<br>
				Copyright © 2019 Petit Poti - Todos os direitos reservados
				<br><br>
				CNPJ 21.609.857/000183
				<br><br>
				Av. Rodrigues Alves, 1276 - Tirol, Natal/RN | CEP 59020-200
			</section>	
		</div>

		<script>
			$(document).ready(function(){
				$('#modal-idiomas').modal({backdrop: 'static'});
			});
		</script>
	</body>
</html>