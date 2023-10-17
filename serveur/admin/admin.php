<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
	<link rel="stylesheet" href="../../client/css/styleFooter.css">
	<link rel="stylesheet" href="../../client/css/styleNav.css">
	<link rel="stylesheet" href="../../client/css/styleTable.css">


	<title>EliteAutomobile</title>
	<script src="../../client/utilitaires/jquery-3.6.3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../../client/voiture/requetesVoiture.js"></script>
	<script src="../../client/voiture/vueVoiture.js"></script>
</head>

<body class="p-0 m-0 border-0 bd-example m-0 border-0" onload="chargerVoituresAJAX('table','../../routes.php');">

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
						<a class="nav-link active" aria-current="page" href="/serveur/admin/admin.php">Accueil</a>
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

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							Lister les membres
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="../membre/page_listerTousLesMembres.php">Tous les membres</a></li>
							<li><a class="dropdown-item" href="../membre/page_listerMembresActif.php">Membres activés</a></li>
							<li><a class="dropdown-item" href="../membre/page_listerMembresDesactives.php">Membres désactivés</a></li>
						</ul>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#">Modifier</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="modal" data-bs-target="#modalAjouterVoiture" href="#">Ajouter une voiture</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="#">Supprimer</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Déconnection</a>
					</li>

				</ul>

			</div>
		</div>
	</nav>

	<!-- Modal enregistrer -->
	<div class="modal fade" id="modalDevenirMembre" tabindex="-1" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Devenir membre</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<span id="msgErrEnreg"></span>
					<form class="row g-3" action="serveur/enregistrerMembre.php" method="POST"
						onSubmit="return validerFormEnreg();">
						<div class="col-md-12">
							<label for="nom" class="form-label">Nom</label>
							<input type="text" class="form-control is-valid" id="nom" name="nom" required>
						</div>
						<div class="col-md-12">
							<label for="prenom" class="form-label">Prénom</label>
							<input type="text" class="form-control is-valid" id="prenom" name="prenom" required>
						</div>
						<div class="col-md-12">
							<label for="courriel" class="form-label">Courriel</label>
							<input type="text" class="form-control is-valid" id="courriel" name="courriel" required>
						</div>

						<div class="form-check">
							<input class="form-check-input" type="radio" name="genre" id="homme" value="option1"
								checked>
							<label class="form-check-label" for="homme">
								Homme
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="genre" id="femme" value="option2">
							<label class="form-check-label" for="femme">
								Femme
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="genre" id="nonBinaire" value="option3">
							<label class="form-check-label" for="nonBinaire">
								Non binaire
							</label>
						</div>

						<div class="col-md-12">
							<label for="date" class="form-label">Date de naissance</label>
							<input type="date" class="form-control is-valid" id="date" name="date" required>
						</div>
						<div class="col-md-12">
							<label for="mdp" class="form-label">Mot de passe</label>
							<input type="password" class="form-control is-valid" id="mdp" name="mdp" required>
						</div>
						<div class="col-md-12">
							<label for="mdpConfirmer" class="form-label">Confirmation du mot de passe</label>
							<input type="password" class="form-control is-valid" id="mdpConfirmer" name="mdpConfirmer"
								required>
						</div>
						<br />
						<div class="col-md-6">
							<button class="btn btn-primary" type="submit">Enregistrer</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger" type="reset">Vider</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalModifierVoiture" tabindex="-1" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Modifier une Voiture</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<span id="msgErrEnreg"></span>
					<form class="row g-3" action="javascript:modifierVoituresAJAX();" method="POST">
						<div class="col-md-12">
							<label for="nomVoiture" class="form-label">Nom</label>
							<input type="text" class="form-control is-valid" id="nomVoiture" name="nomVoiture" required>
						</div>
						<div class="col-md-12">
							<label for="description" class="form-label">description</label>
							<input type="text" class="form-control is-valid" id="description" name="description" required>
						</div>
						<div class="col-md-12">
							<label for="image" class="form-label">image</label>
							<input type="text" class="form-control is-valid" id="image" name="image" required>
						</div>

						<div class="col-md-12">
							<label for="Prix" class="form-label">Prix</label>
							<input type="number" class="form-control is-valid" id="Prix" name="Prix" required>
						</div>
						<div class="col-md-12">
							<label for="Quantité" class="form-label">Quantité</label>
							<input type="number" class="form-control is-valid" id="Quantité" name="Quantité" required>
						</div>

						<br />
						<div class="col-md-6">
							<button class="btn btn-primary" type="submit">Enregistrer</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger" type="reset">Vider</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Cards -->
	<div class="msg" id="msg">
	</div>
	<div  id="contenu">
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
						<p class="mb-0"><small>&copy; EliteAutomobile. Tous droits réservé.</small></p>
					</div>


				</div>
			</div>
		</div>
	</footer>
</body>

</html>