


let lister = (liste) =>{
    let contenu = '<table class="table table-striped table-bordered">';
    contenu += '<thead class="thead-dark">';
    contenu += '<thead>'
    contenu +=        '<tr>'
    contenu +=         '<th>ID</th>'
    contenu +=         '<th>Nom</th>'
    contenu +=         '<th>Prénom</th>'
    contenu +=         '<th>Courriel</th>'
    contenu +=         '<th>Genre</th>'
    contenu +=         '<th>Date de naissance</th>'
    contenu +=        '</tr>'
    contenu +=    '</thead>'
    contenu +=    '<tbody>'
    
    for (let unMembre of liste){
        contenu+=remplirLigne(unMembre);
    } 
    contenu +=    '</tbody>'
    contenu +=    '</table>'
    
    
    document.getElementById('contenu').innerHTML = "";
    document.getElementById('contenu').innerHTML = contenu;

}

function remplirLigne(membre){
    let rep =    '<tr>'
    rep +='<td class="idm">'+membre.idm+'</td>'
    rep +='<td class="nom">'+membre.nom+'</td>'
    rep +='<td class="prenom">'+membre.prenom+'</td>'
    rep +='<td class="courriel">'+membre.courriel+'</td>'
    rep +='<td class="genre">'+membre.genre+'</td>'
    rep +='<td class="daten">'+membre.daten+'</td>'

    rep +='</tr>'        
    return rep;
}

let listerBouton = (liste) =>{
    let contenu = '<table class="table table-striped table-bordered">';
    contenu += '<thead class="thead-dark">';
    contenu += '<thead>'
    contenu +=        '<tr>'
    contenu +=         '<th>ID</th>'
    contenu +=         '<th>Nom</th>'
    contenu +=         '<th>Prénom</th>'
    contenu +=         '<th>Courriel</th>'
    contenu +=         '<th>Genre</th>'
    contenu +=         '<th>Date de naissance</th>'
    contenu +=         '<th>Action</th>'
    contenu +=        '</tr>'
    contenu +=    '</thead>'
    contenu +=    '<tbody>'

    for (let unMembre of liste){
        contenu+=remplirLigneBouton(unMembre);
    } 
    contenu +=    '</tbody>'
    contenu +=    '</table>'
    document.getElementById('contenu').innerHTML = "";
    document.getElementById('contenu').innerHTML = contenu;

}

function remplirLigneBouton(membre){
    let rep =    '<tr>'
    rep +='<td class="idm">'+membre.idm+'</td>'
    rep +='<td class="nom">'+membre.nom+'</td>'
    rep +='<td class="prenom">'+membre.prenom+'</td>'
    rep +='<td class="courriel">'+membre.courriel+'</td>'
    rep +='<td class="genre">'+membre.genre+'</td>'
    rep +='<td class="daten">'+membre.daten+'</td>'
    if (membre.status == "A"){
        rep += `<td><a href="javascript:modifierStatusMembreAJAX('${membre.courriel}','D')" class="btn btn-danger">Désactiver</a></td>`
    }
    else {
        rep +=`<td><a href="javascript:modifierStatusMembreAJAX('${membre.courriel}','A')" class="btn btn-success">Activer</a></td>`
    }
    rep +='</tr>'        
    return rep;
}

function remplirProfil(unMembre){
    let contenu = "";
    contenu +=  `           <div id="modifierMembre">`
    contenu +=  `               <form class="row g-3"  method="POST" id="formModifMembre" >`
    contenu +=  `					<div class="col-md-12 uchangeable">`
	contenu +=  `						<label for="courriel" class="form-label">Courriel</label>`
	contenu +=  `						<input type="text" class="champ desactiver " id="courriel" name="courriel" value="${unMembre.courriel}" disabled>`
	contenu +=  `					</div>`
	contenu +=  `					<div class="col-md-12">`
	contenu +=  `						<label for="nom" class="form-label">Nom</label>`
	contenu +=  `						<input type="text" class="champ desactiver changer" id="nom" name="nom" value="${unMembre.nom}" disabled>`
	contenu +=  `					</div>`
	contenu +=  `					<div class="col-md-12">`
	contenu +=  `						<label for="prenom" class="form-label">Prénom</label>`
	contenu +=  `						<input type="text" class="champ desactiver  changer" id="prenom" name="prenom" value="${unMembre.prenom}" disabled>`
	contenu +=  `					</div>`
    contenu +=  `                   <div class="default" class="col-md-12">`
	contenu +=  `						<label for="genre" class="form-label">Genre</label>`
	contenu +=  `						<input type="text" class="champ desactiver  hide" id="genre" name="genreStatic" value="${unMembre.genre}" disabled>`
	contenu +=  `					</div>`
    contenu +=  `                    <div class="modif"hidden>`
    contenu +=  `                        <div class="form-check">`
    contenu +=  `                            <input class="form-check-input" type="radio" name="genre" id="homme" value="homme">`
    contenu +=  `                            <label class="form-check-label" for="genre">`
    contenu +=  `                                Homme`
    contenu +=  `                            </label>`
    contenu +=  `                       </div>`
    contenu +=  `                        <div class="form-check">`
    contenu +=  `                            <input class="form-check-input" type="radio" name="genre" id="femme" value="femme">`
    contenu +=  `                           <label class="form-check-label" for="genre">`
    contenu +=  `                                Femme`
    contenu +=  `                            </label>`
    contenu +=  `                        </div>`
    contenu +=  `                        <div class="form-check">`
    contenu +=  `                            <input class="form-check-input" type="radio" name="genre" id="nonBinaire" value="nonBinaire">`
    contenu +=  `                            <label class="form-check-label" for="genre">`
    contenu +=  `                                Non binaire`
    contenu +=  `                            </label>`
    contenu +=  `                        </div>`
    contenu +=  `                        <div class="form-check">`
    contenu +=  `                            <input class="form-check-input" type="radio" name="genre" id="nePasDire" value="nePasDire">`
    contenu +=  `                            <label class="form-check-label" for="genre">`
    contenu +=  `                                Préfère ne pas dire`
    contenu +=  `                            </label>`
    contenu +=  `                        </div>`
    contenu +=  `                    </div>`
	contenu +=  `					<div class="col-md-12">`
	contenu +=  `						<label for="date" class="form-label">Date de naissance</label>`
	contenu +=  `						<input type="date" class="champ desactiver  changer" id="date" name="date" value="${unMembre.daten}" disabled>`
	contenu +=  `					</div>`
    contenu +=  `                   <div class="hide" class="col-md-12">`
	contenu +=  `						<label for="mdp" class="form-label">Mot de passe</label>`
	contenu +=  `						<input type="text" class="champ desactiver hide" name="mdp" value="${unMembre.mdp}" disabled>`
	contenu +=  `					</div>`
    contenu +=  `                    <div class="modif"hidden>`
	contenu +=  `					<div class="col-md-12">`
	contenu +=  `						<label for="mdp" class="form-label">Nouveau mot de passe</label>`
	contenu +=  `						<input type="password" class="champ activer " id="mdp" name="mdp" >`
	contenu +=  `					</div>`
	contenu +=  `					<div class="col-md-12" >`
	contenu +=  `						<label for="mdpConfirmer" class="form-label">Confirmation du mot de passe</label>`
	contenu +=  `						<input type="password" class="champ activer " id="mdpConfirmer" name="mdpConfirmer">`
	contenu +=  `					</div>`
    contenu +=  `					<br />`
	contenu +=  `					<div class="col-md-6">`
	contenu +=  `						<button class="modifier" onclick="modifierMembreAJAX('${unMembre.courriel}')">Enregistrer</button>`// type="submit"
	contenu +=  `					</div>`
    contenu +=  `                   </div>`
	contenu +=  `				</form>`
    contenu +=  `				<button class="modifier hide" onclick="afficherModifier()">Modifier</button>`
    contenu +=  `              </div>`
    document.getElementById('contenu').innerHTML = "";
    document.getElementById('contenu').innerHTML = contenu;
}
function afficherModifier(){
    //check le genre présélectionner
    genre = document.getElementById("genre").value;
    switch (genre){
        case "homme":
            document.getElementById("homme").checked = true;
            break;
        case "femme":
            document.getElementById("femme").checked = true;
            break;
        case "nonBinaire":
            document.getElementById("nonBinaire").checked = true;
            break;
        case "nePasDire":
            document.getElementById("nePasDire").checked = true;
            break;
    }

    //activer les champ qui sont modifiable
    inputs = document.getElementsByClassName("changer")
    for (input of inputs){
        input.disabled=false; 
        input.classList.remove("desactiver");
        input.classList.add("activer");
    }

    //cacher les section 
    inputs = document.getElementsByClassName("hide")
    for (input of inputs){
        input.hidden = true; 
    }

    divsModif = document.getElementsByClassName("modif")
    for (div of divsModif){
        div.hidden = false; 
    }
}

function updateNav(nom, prenom){
    document.getElementById("nomMembre").innerText = nom
    document.getElementById("prenomMembre").innerText = prenom
}
