<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
	<link rel="stylesheet" href="./client/css/styleFooter.css">
	<link rel="stylesheet" href="./client/css/styleNav.css">
	<link rel="stylesheet" href="./client/css/styleCard.css">

	<title>EliteAutomobile</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="p-0 m-0 border-0 bd-example m-0 border-0">

	<!-- Header -->
	<header>
		<div class="image-container">
			<img src="client/images/LogoHeader.png" alt="Logo EliteAutomobile">
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
						<a class="nav-link active" aria-current="page" href="#">Accueil</a>
					</li>

                    <li class="nav-item">
						<a class="nav-link active" aria-current="page" href="serveur/membre/page_connexion.php">Connection</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalDevenirMembre">Devenir membre</a>
						<!-- <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalDevenirMembre">Enregistrer(C)</a> -->
					</li>

					<li class="nav-item">
						<a class="nav-link" href="#">Contactez-nous</a>
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
					<form class="row g-3" action="serveur/membre/enregistrerMembre.php" method="POST"
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
							<input class="form-check-input" type="radio" name="genre" id="homme" value="homme"
								checked>
							<label class="form-check-label" for="genre">
								Homme
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="genre" id="femme" value="femme">
							<label class="form-check-label" for="genre">
								Femme
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="genre" id="nonBinaire" value="nonBinaire">
							<label class="form-check-label" for="genre">
								Non binaire
							</label>
						</div>

                        <div class="form-check">
							<input class="form-check-input" type="radio" name="genre" id="nePasDire" value="nePasDire">
							<label class="form-check-label" for="genre">
								Préfère ne pas dire
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

	<!-- Footer -->
	<div class="card-box">
		<div class="product-card">
			<div class="product-img">
				<img src="client/images/image1.jpg" alt="RR-P">
				<h1>Rolls-Royce Phantom</h1>
			</div>
			<div class="product-description">
				<p>La berline de très grand luxe qui n’a plus aucune rivale directe ne se mesure qu’aux caprices de ses richissimes acheteurs. Elle leur offre une infinité ou presque d’options de personnalisation. Son V12 turbocompressé de 6,75 litres sous le capot fournit une puissance de 563 chevaux, mais il n’y a toujours pas de version Black Badge comme avec les Cullinan et Ghost. En revanche, il faut souligner que la Phantom profite de retouches esthétiques pour 2023.</p>
				<p>Bleu</p>
			</div>
			<div class="product-price">
				<p>Commence a <span>625,000 $</span></p>
			</div>
			<div class="product-stock">
				<p>10 en stock</p>
			</div>
			<div class="product-achat">
				<a href="#" class="btn btn-primary">Acheter</a>
			</div>
		</div>

		<div class="product-card">
			<div class="product-img">
				<img src="client/images/image2.jpg" alt="B-F-S">
				<h1>Bentley Flying Spur</h1>
			</div>
			<div class="product-description">
				<p>Véritable salon anglais sur quatre roues, la berline Flying Spur représente tout le savoir faire de Bentley. Trois motorisations sont disponibles : un V6 hybride rechargeable de 3 litres, un V8 de 4 litres ou un monstrueux W12 de 6 litres. Pour l’année-modèle 2023, la Flying Spur s’enrichit d’une version Azure, comme les Bentayga et Continental GT. Il est aussi possible d’opter pour la nouvelle variante S, qui se veut plus sportive.</p>
				<p>Orange</p>
			</div>
			<div class="product-price">
				<p>Commence a <span>381,400 $</span></p>
			</div>
			<div class="product-stock">
				<p>20 en stock</p>
			</div>
			<div class="product-achat">
				<a href="#" class="btn btn-primary">Acheter</a>
			</div>
		</div>

		<div class="product-card">
			<div class="product-img">
				<img src="client/images/image3.jpg" alt="B-C">
				<h1>Bentley Continental GT</h1>
			</div>
			<div class="product-description">
				<p>La Continental GT est, comme son nom l’indique, une voiture de grand tourisme. Sous son long capot, loge un V8 de 4 litres de 542 chevaux et 569 lb-pi, ou un W12 de 6 litres qui revendique 650 chevaux et 664 lb-pi. Contrairement au Bentayga, il n’y a pas de version hybride disponible. En 2023, à l’image du reste de la gamme Bentley, la Continental GT s’enrichit d’une nouvelle version Azure, encore plus luxueuse et raffinée.</p>
				<p>Turquoise</p>
			</div>
			<div class="product-price">
				<p>Commence a <span>450,000 $</span></p>
			</div>
			<div class="product-stock">
				<p>17 en stock</p>
			</div>
			<div class="product-achat">
				<a href="#" class="btn btn-primary">Acheter</a>
			</div>
		</div>

		<div class="product-card">
			<div class="product-img">
				<img src="client/images/image4.jpg" alt="RR-W">
				<h1>Rolls-Royce Wraith</h1>
			</div>
			<div class="product-description">
				<p>La plus sportive des Rolls, si l’on veut, c’est le coupé Wraith. En déclinaison Black Badge, elle est également très rapide, alors que son V12 biturbo de 624 chevaux voit son couple passer de 605 à 642 livres-pied. En option, outre une liste infinie de choix de personnalisation, on peut se procurer un plafonnier parsemé de minuscules lumières DEL, émulant un ciel étoilé. Le système multimédia des Rolls, basé sur le iDrive de BMW, est d’une convivialité déconcertante.</p>
				<p>Bleu</p>
			</div>
			<div class="product-price">
				<p>Commence a <span>522,197 $</span></p>
			</div>
			<div class="product-stock">
				<p>8 en stock</p>
			</div>
			<div class="product-achat">
				<a href="#" class="btn btn-primary">Acheter</a>
			</div>
		</div>

		<div class="product-card">
			<div class="product-img">
				<img src="client/images/image5.jpg" alt="RR-G">
				<h1>Rolls-Royce Ghost</h1>
			</div>
			<div class="product-description">
				<p>Deux ans après son renouvellement complet, la Ghost continue d’impressionner avec sa nouvelle plateforme tout en aluminium appelée « Architecture of Luxury » et sa technologie de suspension planaire qui neutralise les vibrations pour un confort de roulement optimal. Comme avec toute Rolls-Royce, les options de personnalisation sont illimitées ou presque. Selon la version choisie, le V12 turbocompressé de 6,75 litres sous le capot génère 563 ou 591 chevaux… et brûle de l’essence sans modération.</p>
				<p>Saumon</p>
			</div>
			<div class="product-price">
				<p>Commence a <span>475,000 $</span></p>
			</div>
			<div class="product-stock">
				<p>3 en stock</p>
			</div>
			<div class="product-achat">
				<a href="#" class="btn btn-primary">Acheter</a>
			</div>
		</div>

		<div class="product-card">
			<div class="product-img">
				<img src="client/images/image6.jpg" alt="M-M-S">
				<h1>Mercedes-Maybach S-Class</h1>
			</div>
			<div class="product-description">
				<p>Grande berline de luxe, la Mercedes-Classe S concurrence les Audi A8 et BMW Série 7 notamment. Entièrement renouvelée en 2021, elle ne propose pas de grande nouveauté pour 2023. Elle est offerte en versions 500 4MATIC, 580 4MATIC et Maybach 580 4MATIC. Cette dernière coûte pratiquement deux fois le prix d’une Classe S dite de base. Au catalogue, on retrouve deux mécaniques : le 6 cylindres en ligne de 3 litres et le V8 de 4 litres.</p>
				<p>Noir</p>
			</div>
			<div class="product-price">
				<p>Commence a <span>249,900 $</span></p>
			</div>
			<div class="product-stock">
				<p>25 en stock</p>
			</div>
			<div class="product-achat">
				<a href="#" class="btn btn-primary">Acheter</a>
			</div>
		</div>

		<div class="product-card">
			<div class="product-img">
				<img src="client/images/image7.jpg" alt="M-B-E">
				<h1>Mercedes-Benz Classe E</h1>
			</div>
			<div class="product-description">
				<p>Berline intermédiaire de luxe, la Mercedes-Benz Classe E est l’éternelle rivale des Audi A6 et BMW Série 5 notamment. En plus de la berline, le constructeur allemand propose le coupé, le cabriolet la familiale. Le modèle en est à sa cinquième génération depuis 2016. Les consommateurs ont le choix entre un moteur turbocompressé à 4 cylindres de 2 litres et le bloc à 6 cylindres en ligne de 3 litres. Elle est assemblée en Allemagne.</p>
				<p>Gris.</p>
			</div>
			<div class="product-price">
				<p>Commence a <span>142,000 $.</span></p>
			</div>
			<div class="product-stock">
				<p>30 en stock.</p>
			</div>
			<div class="product-achat">
				<a href="#" class="btn btn-primary">Acheter</a>
			</div>
		</div>

		<div class="product-card">
			<div class="product-img">
				<img src="client/images/image8.jpg" alt="G-G">
				<h1>Genesis G70</h1>
			</div>
			<div class="product-description">
				<p>La Genesis G70 est une berline compacte de luxe qui concurrence notamment les Audi A4, BMW Série 3 et Mercedes-Benz Classe C. Ses versions de base reçoivent un moteur quatre cylindres turbo 2 litres de 252 chevaux et 260 lb-pi de couple. Pour plus de puissance, le V6 3,3 litres biturbo figure au menu, il produit 365 chevaux et 375 lb-pi. Le système multimédia incorpore un écran de 10,25 pouces. Apple CarPlay et Android Auto arrivent de série.</p>
				<p>Noir.</p>
			</div>
			<div class="product-price">
				<p>Commence a <span>61,000 $.</span></p>
			</div>
			<div class="product-stock">
				<p>6 en stock.</p>
			</div>
			<div class="product-achat">
				<a href="#" class="btn btn-primary">Acheter</a>
			</div>
		</div>

		<div class="product-card">
			<div class="product-img">
				<img src="client/images/image9.jpg" alt="RR-P">
				<h1>Audi A5</h1>
			</div>
			<div class="product-description">
				<p>Berline compacte emblématique de chez Audi, l’A4 poursuit sa route pratiquement inchangée. Les principaux changements étant le retrait du modèle de base 40 TFSI, l’ajout de nouvelles jantes et la révision de certains équipements de confort et de sécurité. Du côté des motorisations, deux possibilités sont offertes : un 4 cylindres de 2 litres (261 chevaux) pour la berline et la familiale Allroad, et un V6 biturbo de 3 litres (349 chevaux) pour la déclinaison S4.</p>
				<p>Gris.</p>
			</div>
			<div class="product-price">
				<p>Commence a <span>65,950 $.</span></p>
			</div>
			<div class="product-stock">
				<p>16 en stock.</p>
			</div>
			<div class="product-achat">
				<a href="#" class="btn btn-primary">Acheter</a>
			</div>
		</div>
	</div>

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