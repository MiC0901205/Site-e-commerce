<!DOCTYPE html>
<html>
<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
?>
<head>
	<title>Site en ligne de batteries externes </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="./css/principal.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="./js/accueil.js"></script> 
</head>
<body>
	<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="./img/OIP.jpg" class="d-block w-100" alt="...">
      		</div>
			<div class="carousel-item">
				<img src="./img/batterie_antichoc/batterie_antichoc.jpg" class="d-block w-50 responsive" alt="...">
			</div>
			<div class="carousel-item">
				<img src="./img/batterie_ronde/batterie_externe.jpg" class="d-block w-50 responsive" alt="...">
			</div>
		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>
	<nav class="navbar navbar-expand-lg navbar-light">
		<!-- couleur et style -->
		<div class="container-fluid d-flex">
			<a class="navbar-brand" href="index.php">Site de batteries externes</a>
			<!-- nom du site gauche navbar -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
				aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!--  style pour "périphériques externes" -->
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<!--  style navbar -->

					<li class="nav-item dropdown">
						<a class="nav-link active dropdown-toggle" aria-current="page" role="button"
							data-bs-toggle="dropdown" href="#">Types</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="ronde.php">Ronde</a></li>
							<li><a class="dropdown-item" href="compacte.php">UltraCompacte</a></li>
							<li><a class="dropdown-item" href="antichoc.php">Antichoc</a></li>
						</ul>
					</li>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link active dropdown-toggle" aria-current="page" role="button"
							data-bs-toggle="dropdown" href="#"> Capacités </a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="ampere5.php">5000 Ampères</a></li>
							<li><a class="dropdown-item" href="ampere20.php">20000 Ampères</a></li>
							<li><a class="dropdown-item" href="ampere40.php">40000 Ampères</a></li>
						</ul>
					</li>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link active dropdown-toggle" aria-current="page" role="button"
							data-bs-toggle="dropdown" href="#"> Tailles </a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="petite.php">Petite</a></li>
							<li><a class="dropdown-item" href="moyenne.php">Moyenne</a></li>
							<li><a class="dropdown-item" href="grande.php">Grande</a></li>
						</ul>
					</li>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link active dropdown-toggle" aria-current="page" role="button"
							data-bs-toggle="dropdown" href="#"> Plus de produits </a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="souris.php"> Souris </a></li>
							<li><a class="dropdown-item" href="cable.php"> Câbles de recharge</a></li>
							<li><a class="dropdown-item" href="clavier.php"> Clavier </a></li>
						</ul>
					</li>
					</li>
				</ul>
			</div>
			<form action="recherche.php" method="GET" class="d-flex search">
				<input class="form-control me-2" name="search" type="search" placeholder="Rechercher" aria-label="Search">
				<button class="btn btn-outline-success" type="submit">Rechercher</button>
			</form>
			<li class="btn btn-panier">
				<a href="panier.php">
					<img src="./img/panier-removebg-preview.png" height="30px" width="30px">
				</a>
			</li>
			<?php
				if(!empty($_SESSION['adresse_mail'])) {
					if(isset($_SESSION['lastdate'])){
						$datecourante = new DateTime();
						$currentTimestamp = $datecourante->getTimestamp();
						if($currentTimestamp - $_SESSION['lastdate'] > 300){
							header('Location: Deconnexion.php?afk=true');
						}
					} 
					$date = new DateTime();
					$_SESSION['lastdate'] = $date->getTimestamp();
				}

				$parameterUser = '<li><a class="dropdown-item" href="Infosclient.php"> Mon profil </a></li>
				<li><a class="dropdown-item" href="historique_cmd.php"> Mon historique </a></li>
				<li><a class="dropdown-item" href="./index.php?uc=logout&action=logout"> Deconnexion </a></li>
					</ul>
				</li>';
				if(isset($_SESSION['adresse_mail'])){
					echo '<li class="nav-item dropdown btn-deconnexion">
							<a class="nav-link active " aria-current="page" role="button"
							data-bs-toggle="dropdown" href="#"><img src="./img/account logo.jpg" height="30px" width="30px"></a>
							<ul class="dropdown-menu dropdown-menu-end">';
							if(isset($_SESSION['isAdmin'])) {
								if($_SESSION['isAdmin'] == 1) {
									echo '<li><a class="dropdown-item" href="#"> Administration </a></li>';
									echo $parameterUser;		
								} else {
									echo $parameterUser;		
								}
							} else {
								echo $parameterUser;		
							}
					echo '<div id="connecter"></div>';
				} else {
					echo '<li class="btn btn-connexion">
							<a href="./index.php?uc=login&action=demandeConnexion">
								<img src="./img/account logo.jpg" height="30px" width="30px">
							</a>
						</li>';
				}

				if(isset($_GET['afk']) && $_GET['afk'] == true){
					echo "Vous êtes déconnecté pour cause d'inactivité";
				} else {
					"Vous êtes bien connecté";
				}
			?>
		</div>
	</nav>
