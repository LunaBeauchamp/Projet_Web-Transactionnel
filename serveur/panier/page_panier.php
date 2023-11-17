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
	<link rel="stylesheet" href="../../client/css/stylePanier.css">
	<link rel="stylesheet" href="../../client/css/styleProfil.css">


	<title>EliteAutomobile</title>
	<script src="../../client/utilitaires/jquery-3.6.3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
	<script src="../../client/membre/vueMembre.js"></script>
	<script src="../../client/membre/requetesMembre.js"></script>
	<script src="../../client/voiture/vueVoiture.js"></script>
	<script src="../../client/voiture/requetesVoiture.js"></script>
</head>

<body class="p-0 m-0 border-0 bd-example m-0 border-0">

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
						<a class="nav-link active" aria-current="page" href="../membre/membre.php">Accueil</a>
					</li>
					
					<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="javascript:afficherProfil('<?php echo $_SESSION['courriel']; ?>')">Profil</a>
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

					<li class="nav-item" >
						<a class="nav-link" href="javascript:afficherPanier()">
							<div class="cart-icon" id="panierSpanIcon">
								<i class="fas fa-shopping-cart fa-2x"></i>
							</div>
						</a>
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
	<div id="contenu">
	</div>
	<!-- Table -->
	<div id="contenuPanier">
		<div id="panierTable"></div>
		<div id="prixTotal"></div>
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
		function afficherPanier(){
			let div = document.getElementById("contenuPanier");
			div.hidden = false;
			document.getElementById('contenu').innerHTML = "";
		}
		function afficherProfil(courriel){
			let div = document.getElementById("contenuPanier");
			div.hidden = true;
			chargerUnMembreAJAX(courriel)
		}
	</script>
	<script>
		let itemsPanier = JSON.parse(localStorage.getItem('itemsPanier')) || [];
		let itemsSpanPanierCountDiv = document.getElementById("panierSpanIcon");
		let itemsSpanPanierCount = document.createElement("span");
		itemsSpanPanierCount.textContent = itemsPanier.length;
		itemsSpanPanierCount.classList.add("cart-badge");
		itemsSpanPanierCount.setAttribute("id", "nbItem");
		itemsSpanPanierCountDiv.appendChild(itemsSpanPanierCount);
	</script>
	<script>
		const panierTableDiv = document.getElementById('panierTable');
		if (itemsPanier.length == 0) {
			let h2VidePanier = document.createElement('h2');
			h2VidePanier.textContent = "Le panier est vide."
			panierTableDiv.appendChild(h2VidePanier);
		} else {
			const table = document.createElement('table');

			const thead = table.createTHead();
			const headerRow = thead.insertRow();
			for (const key in itemsPanier[0]) {
				const th = document.createElement('th');
				th.textContent = key;
				headerRow.appendChild(th);
			}

			const actionHeader = document.createElement('th');
			actionHeader.textContent = 'Action';
			headerRow.appendChild(actionHeader);

			const tbody = table.createTBody();
			itemsPanier.forEach((item, index) => {
				const row = tbody.insertRow();
				for (const key in item) {
					const cell = row.insertCell();
					if (key.toLowerCase() === 'image') {
						const img = document.createElement('img');
						img.src = item[key];
						img.alt = 'Image';
						img.width = 150;
						img.height = 150;
						cell.appendChild(img);
					} else {
						cell.textContent = item[key];
					}
				}

				const actionCell = row.insertCell();
				const button = document.createElement('button');
				button.textContent = 'Supprimer';
				button.style.backgroundColor = 'red';
				button.style.color = 'white';

				button.addEventListener('click', () => {
					itemsPanier.splice(index, 1);
					localStorage.setItem('itemsPanier', JSON.stringify(itemsPanier));
					location.reload();
				});

				actionCell.appendChild(button);
			});

			panierTableDiv.appendChild(table);
		}

		const prixTotalDiv = document.getElementById('prixTotal');
		const totalSansTaxeH4 = document.createElement('h4');
		totalSansTaxeH4.textContent = 'Sous-total: ' + calculateSousTotalPrice(itemsPanier) + '$';
		const tpsH4 = document.createElement('h4');
		tpsH4.textContent = 'TPS: ' + calculateTPSPrice(itemsPanier) + '$';
		const tvqH4 = document.createElement('h4');
		tvqH4.textContent = 'TVQ: ' + calculateTVQPrice(itemsPanier) + '$';
		const totalH2 = document.createElement('h2');
		totalH2.textContent = 'Prix total: ' + calculateTotalPrice(itemsPanier) + '$';
		totalH2.setAttribute("id","prixTotal");

		const buttonPaypal = document.createElement('button');
		buttonPaypal.textContent = "Payer";
		buttonPaypal.setAttribute("onclick","payer();");
		buttonPaypal.setAttribute("class","payer");
		prixTotalDiv.appendChild(totalSansTaxeH4);
		prixTotalDiv.appendChild(tpsH4);
		prixTotalDiv.appendChild(tvqH4);
		prixTotalDiv.appendChild(totalH2);
		prixTotalDiv.appendChild(buttonPaypal);

		function calculateSousTotalPrice(items) {
			let totalPrice = 0;
			items.forEach(item => {
				totalPrice += item.prix * item.quantite;
			});
			return totalPrice.toFixed(2);
		}

		function calculateTPSPrice(items) {
			let totalPrice = 0;
			items.forEach(item => {
				totalPrice += item.prix * item.quantite;
				totalPrice = totalPrice * (5/100);
			});
			return totalPrice.toFixed(2);
		}

		function calculateTVQPrice(items) {
			let totalPrice = 0;
			items.forEach(item => {
				totalPrice += item.prix * item.quantite;
				totalPrice = totalPrice * (10/100);
			});
			return totalPrice.toFixed(2);
		}

		function calculateTotalPrice(items) {
			let totalPrice = 0;
			items.forEach(item => {
				totalPrice += item.prix * item.quantite;
				let tps = totalPrice * (5/100);
				let tvq = totalPrice * (10/100);
				totalPrice = totalPrice + tps + tvq;
			});
			return totalPrice.toFixed(2);
		}

		
	</script>


</body>

</html>