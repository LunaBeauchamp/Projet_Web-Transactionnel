
let remplirCard = (uneVoiture)=> {
    let rep =    ' <div class="product-card">';
    rep +='<div class="product-img">';
                 rep +=' <img src="'+uneVoiture.image+'" alt="RR-P">';
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
    rep +='<td ><img src="'+uneVoiture.image+'"class="imageVoiture"></td>'
    rep +='<td class="idVoiture">'+uneVoiture.idVoiture+'</td>'
    rep +='<td class="nomVoiture">'+uneVoiture.nomVoiture+'</td>'
    rep +='<td class="descriptionVoiture">'+uneVoiture.description+'</td>'
    rep +='<td class="prixVoiture">'+uneVoiture.prix+'$</td>'
    rep +='<td class="quantiteVoiture">'+uneVoiture.quantite+'</td>'
    rep +='<td ><button data-bs-toggle="modal" data-bs-target="#modalModifierVoiture">modifier</button></td>'
    rep +='<td ><button>supprimer</button></td>'
    rep +='</tr>'        
        return rep;
}


let listerVoituresTable = () => {
    document.getElementById('contenu').innerHTM = ""
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