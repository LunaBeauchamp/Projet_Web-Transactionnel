<html lang="fr">
<?php
    session_start();
    if(!isset($_SESSION['role'])){
         header('Location: ../../index.php');
         exit();
    }
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
	<link rel="stylesheet" href="../../client/css/styleFooter.css">
	<link rel="stylesheet" href="../../client/css/styleNav.css">
	<link rel="stylesheet" href="../../client/css/styleTable.css">
	<link rel="stylesheet" href="../../client/css/styleCard.css">
	<link rel="stylesheet" href="../../client/css/styleProfil.css">


	<title>EliteAutomobile</title>
	<script src="../../client/utilitaires/jquery-3.6.3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
	<script src="../../client/voiture/requetesVoiture.js"></script>
	<script src="../../client/voiture/vueVoitureConnecter.js"></script>
	<script src="../../client/membre/vueMembre.js"></script>
	<script src="../../client/membre/requetesMembre.js"></script>
</head>

<body class="p-0 m-0 border-0 bd-example m-0 border-0" onload="chargerVoituresAJAX('cards','../../routes.php'); updateNav('<?php echo $_SESSION['nom']; ?>','<?php echo $_SESSION['prenom']; ?>')">

	<!-- Header -->
	<header>
		<div class="image-container">
			<img src="../../client/images/LogoHeader.png" alt="Logo EliteAutomobile">
		</div>
	</header>

	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">EliteAutomobile</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="">Accueil</a><!--Afficher les produits-->
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							Lister par catégorie
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="javascript:listerPar('id')">ID</a></li>
							<li><a class="dropdown-item" href="javascript:listerPar('nom')">Nom</a></li>
							<li><a class="dropdown-item" href="javascript:listerPar('prix')">Prix</a></li>
							<li><a class="dropdown-item" href="javascript:listerPar('quantite')">Quantité</a></li>
						</ul>
					</li>

                    <li class="nav-item">
						<div class="input-group search-bar">
							<input type="search" id="chercher" class="form-control rounded search" placeholder="Rechercher..." aria-label="Search" aria-describedby="search-addon" />
							<button type="button"  class="btn btn-outline-primary search" onclick="chercherVoituresAJAX()">Rechercher</button>
						</div>
					</li>

					<li class="nav-item" >
						<a class="nav-link" href="../panier/page_panier.php">
							<div class="cart-icon" id="panierSpanIcon">
								<i class="fas fa-shopping-cart fa-2x"></i>
							</div>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="javascript:chargerUnMembreAJAX('<?php echo $_SESSION['courriel']; ?>')">Profil</a><!--Afficher le profil avec option de modification-->
					</li>

                    <li class="nav-item">
						<p id="nomMembre" class="nav-link active" aria-current="page"><?php echo $_SESSION['nom']; ?></p>
					</li>
                    <li class="nav-item">
						<p id="prenomMembre" class="nav-link active" aria-current="page"><?php echo $_SESSION['prenom']; ?></p>
					</li>
				
					<li class="nav-item">
						<a class="nav-link" href="../../index.php">Déconnection</a>
					</li>


				</ul>

			</div>
		</div>
	</nav>

	

	<!-- Toast  -->
	<div class="toast posToast" role="status" aria-live="polite" aria-atomic="true" data-delay="5000">
		<div class="toast-header">
			<img src="../../client/images/message2.png" class="rounded mr-2">
			<strong class="mr-auto">Message</strong>
		</div>
		<div id="textToast" class="toast-body">
			<!--Afficher le message voulu-->
			<div class="toast-buttons">
				<button id="yesButton" class="btn btn-success">Oui</button>
				<button id="cancelButton" class="btn btn-danger">Annuler</button>
			</div>
		</div>
	</div>

	<!-- Cards -->
	<div class="msg" id="msg">
	</div>
	<div class="formulaire" id="formulaire">
	</div>
	<div id="contenu">
	</div>

	<!-- Footer -->
	<footer class="footer-16371">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-9 text-center">
					<div class="footer-site-logo mb-4">
						<a href="#">EliteAutomobile</a>
					</div>
					<ul class="list-unstyled nav-links mb-5">
						<li><a href="#">À propos de nous</a></li>
						<li><a href="#">Nos services</a></li>
						<li><a href="#">Carrière</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Légal</a></li>
						<li><a href="#">Contact</a></li>
					</ul>

					<div class="social mb-4">
						<h3>EliteAutomobile : L'excellence en mouvement.</h3>
						<ul class="list-unstyled">
							<li class="in"><a href="#"><span class="icon-instagram"></span></a></li>
							<li class="fb"><a href="#"><span class="icon-facebook"></span></a></li>
							<li class="tw"><a href="#"><span class="icon-twitter"></span></a></li>
							<li class="pin"><a href="#"><span class="icon-pinterest"></span></a></li>
							<li class="dr"><a href="#"><span class="icon-dribbble"></span></a></li>
						</ul>
					</div>

					<div class="copyright">
						<p class="mb-0"><small>&copy; EliteAutomobile. Tous droits réservés.</small></p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<script>
		let itemsPanier = JSON.parse(localStorage.getItem('itemsPanier')) || [];
		let itemsSpanPanierCountDiv = document.getElementById("panierSpanIcon");
		let itemsSpanPanierCount = document.createElement("span");
		itemsSpanPanierCount.textContent = itemsPanier.length;
		itemsSpanPanierCount.classList.add("cart-badge");
		itemsSpanPanierCountDiv.appendChild(itemsSpanPanierCount);
		
	</script>
</body>

</html>