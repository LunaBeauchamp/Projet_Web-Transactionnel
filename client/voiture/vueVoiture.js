function montrerFormEnreg(){
     let form=`
     <!-- Modal pour enregistrer voiture -->
         <div class="modal fade" id="enregModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une Voiture</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <span id="msgErrEnreg"></span>
                     <form class="row g-3" id="formEnreg" onSubmit="ajouterVoituresAJAX();" method="POST">
                     <div class="col-md-12">
                     <label for="nomVoiture" class="form-label">Nom</label>
                     <input type="text" class="form-control is-valid" id="nomVoiture" name="nomVoiture" required>
                 </div>
                 <div class="col-md-12">
                     <label for="description" class="form-label">Description</label>
                     <input type="text" class="form-control is-valid" id="description" name="description" required>
                 </div>
                 <div class="col-md-12">
                 <label for="image" class="form-label">Image URL format jpg</label>
                     <input type="file" class="form-control is-valid" id="image" name="image" required>
                 </div>
                 <div class="col-md-12">
                     <label for="prix" class="form-label">Prix</label>
                     <input type="number" class="form-control is-valid" id="prix" name="prix" required>
                 </div>
                 <div class="col-md-12">
                     <label for="quantite" class="form-label">Quantité</label>
                     <input type="number" class="form-control is-valid" id="quantite" name="quantite" required>
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
</div>
        <!-- Fin du modal pour enregistrer film -->
    `;
contenu = document.getElementById("formulaire")
contenu.innerHTML = form;
$('#enregModal').modal('show');
}

function montrerFormModif(voiture) {
    let form = `<!-- Modal pour modifier voiture -->
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
					<form class="row g-3" id="formModif" onSubmit="modifierVoituresAJAX(${voiture.idVoiture},'${voiture.image}');" method="POST">
						<div class="col-md-12">
							<label for="nomVoiture" class="form-label">Nom</label>
							<input type="text" class="form-control is-valid" id="nomVoiture" name="nomVoiture" value="${voiture.nomVoiture}" required>
						</div>
						<div class="col-md-12">
							<label for="description" class="form-label">Description</label>
							<input type="text" class="form-control is-valid" id="description" name="description" value="${voiture.description}" required>
						</div>
						<div class="col-md-12">
							<label for="image" class="form-label">Image</label>
							<input type="file" class="form-control is-valid" id="image" name="image">
						</div>
						<div class="col-md-12">
							<label for="prix" class="form-label">Prix</label>
							<input type="number" class="form-control is-valid" id="prix" name="prix" value="${voiture.prix}" required>
						</div>
						<div class="col-md-12">
							<label for="quantite" class="form-label">Quantité</label>
							<input type="number" class="form-control is-valid" id="quantite" name="quantite" value="${voiture.quantite}" required>
						</div>
						<br />
						<div class="col-md-6">
							<button class="btn btn-primary" type="submit">Modifier</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-danger" type="reset">Vider</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    <!-- Fin du modal modifier voiture -->`

document.getElementById('formulaire').innerHTML = form;
$('#modalModifierVoiture').modal('show');
}

let remplirCard = (uneVoiture)=> {
    let rep =    ' <div class="product-card">';
    rep +='<div class="product-img">';
                 rep +=' <img src="serveur/pochettes/'+uneVoiture.image+'" alt="RR-P">';
                 rep +=' <h1>'+uneVoiture.nomVoiture+'</h1>';
                 rep +=' </div>';
                 rep +=' <div class="product-description">';
                 rep +=' <p>'+uneVoiture.description+'</p>';
                 rep +=' </div>';
                 rep +=' <div class="product-price">';
                 rep +=' <p>Commence a <span>'+uneVoiture.prix +'$</span></p>';
                 rep +=' </div>';
                 rep +=' <div class="product-achat">';
                 rep +=' <a href="#" class="btn btn-primary">Acheter</a>';
                 rep +=' </div>';
                 rep +=' </div>';
             
        return rep;
}

let listerVoituresCards = () => {


let contenu = "";
for (let uneVoiture of listeVoitures){
    if (uneVoiture.nodeName != "<voitures>"){
        contenu+=remplirCard(uneVoiture);
    }
    
} 
document.getElementById('contenu').innerHTML = contenu;
}

let remplirTable = (uneVoiture)=> {
    let rep =    '<tr>'
    rep +='<td ><img src="../pochettes/'+uneVoiture.image+'"class="imageVoiture"></td>'
    rep +='<td class="idVoiture">'+uneVoiture.idVoiture+'</td>'
    rep +='<td class="nomVoiture">'+uneVoiture.nomVoiture+'</td>'
    rep +='<td class="descriptionVoiture">'+uneVoiture.description+'</td>'
    rep +='<td class="prixVoiture">'+uneVoiture.prix+'$</td>'
    rep +='<td class="quantiteVoiture">'+uneVoiture.quantite+'</td>'
    rep +='<td ><button onclick="listerOneVoituresAJAX('+uneVoiture.idVoiture+')">modifier</button></td>'
    rep +='<td ><button onclick="supprimerVoituresAJAX('+uneVoiture.idVoiture+')">supprimer</button></td>'
    rep +='</tr>'        
        return rep;
}


let listerVoituresTable = () => {

let contenu = '<div class="table-responsive">'
    contenu += '<table class="table-striped table-sm align-middle">'
    contenu += '<thead>'
    contenu +=        '<tr>'
    contenu +=         '<th>Image</th>'
    contenu +=         '<th>ID</th>'
    contenu +=         '<th>Nom</th>'
    contenu +=         '<th>Description</th>'
    contenu +=         '<th>Prix</th>'
    contenu +=         '<th>Quantité</th>'
    contenu +=         '<th>Modifier</th>'
    contenu +=         '<th>Supprimer</th>'
    contenu +=        '</tr>'
    contenu +=    '</thead>'
    contenu +=    '<tbody>'

for (let uneVoiture of listeVoitures){
    if (uneVoiture.nodeName != "<voitures>"){
        contenu+=remplirTable(uneVoiture);
    }
    
} 
contenu +=    '</tbody>'
contenu +=    '</table>'
contenu +=    '</div>'
document.getElementById('contenu').innerHTML = contenu;
}

let afficherMessage = (msg) => {
document.getElementById('msg').innerHTML = msg;
setTimeout(() => {
    document.getElementById('msg').innerHTML = "";
}, 5000);
}

let listerPar = (par="id", type="table") => {
switch(par){
    case"nom":
        listeVoitures.sort(function(a, b){
            let x = a.nomVoiture.toLowerCase();
            let y = b.nomVoiture.toLowerCase();
            if (x < y) {return -1;}
            if (x > y) {return 1;}
            return 0;
            });
        break;
    case"prix":
        listeVoitures.sort(function(a, b){return a.prix - b.prix});
        break;
    case"quantite":
        listeVoitures.sort(function(a, b){return a.quantite - b.quantite});
        break;
    case"id":
    default:
        listeVoitures.sort(function(a, b){return a.idVoiture - b.idVoiture});
        break;
}
switch(type){
    case"card":listerVoituresCards();
    break;
    case"table":listerVoituresTable();
}
}

let montrerVue = (action, xmlReponse) => {

switch(action){
    case "enregistrer"  :
    case "modifier"     :
    case "enlever"      :
        afficherMessage(xmlReponse.getElementsByTagName('msg')[0].firstChild.nodeValue);
    break;
    case "lister_cards"       :
        if(xmlReponse.firstChild.nodeName == 'message'){
            afficherMessage(xmlReponse.getElementsByTagName('msg')[0].firstChild.nodeValue);
        } else {
            listerPar(null,"card");
        }
    break;
    case "lister_table"       :
        if(xmlReponse.firstChild.nodeName == 'message'){
            afficherMessage(xmlReponse.getElementsByTagName('msg')[0].firstChild.nodeValue);
        } else {
            listerPar();
        }
        break;
}
}