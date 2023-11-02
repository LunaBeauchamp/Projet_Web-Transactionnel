
let afficherTexte = (msg)=>{
    contenu = `<p>${msg}</p>`
    document.getElementById('msg').innerHTML = "";
    document.getElementById('msg').innerHTML = contenu;
}

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
    rep +='<td class="courriel">'+membre.courriel+'$</td>'
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
