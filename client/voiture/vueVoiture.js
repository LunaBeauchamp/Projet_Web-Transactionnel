let remplirCard = (uneVoiture)=> {
    console.log(uneVoiture);
    let nomvoiture = uneVoiture.getElementsByTagName('nomvoiture')[0].firstChild.nodeValue;
    let image = uneVoiture.getElementsByTagName('image')[0].firstChild.nodeValue;
    let description = uneVoiture.getElementsByTagName('description')[0].firstChild.nodeValue;
    let prix = uneVoiture.getElementsByTagName('prix')[0].firstChild.nodeValue;
    let rep =    ' <div class="product-card">';
    rep +='<div class="product-img">';
                 rep +=' <img src="'+image+'" alt="RR-P">';
                 rep +=' <h1>'+nomvoiture+'</h1>';
                 rep +=' </div>';
                 rep +=' <div class="product-description">';
                 rep +=' <p>'+description+'</p>';
                 rep +=' </div>';
                 rep +=' <div class="product-price">';
                 rep +=' <p>Commence a <span>'+prix +'$</span></p>';
                 rep +=' </div>';
                 rep +=' <div class="product-achat">';
                 rep +=' <a href="#" class="btn btn-primary">Acheter</a>';
                 rep +=' </div>';
                 rep +=' </div>';
             
        return rep;
}

let listerVoitures = (xmlReponse) => {
    let listeVoitures = xmlReponse.getElementsByTagName('voiture');

    let contenu = "";
    for (let uneVoiture of listeVoitures){
        if (uneVoiture.nodeName != "<voitures>"){
            contenu+=remplirCard(uneVoiture);
        }
        
    } 
    document.getElementById('cardVoiture').innerHTML = contenu;
}

let afficherMessage = (msg) => {
    document.getElementById('msg').innerHTML = msg;
    setTimeout(() => {
        document.getElementById('msg').innerHTML = "";
    }, 5000);
}

let montrerVue = (action, xmlReponse) => {

    switch(action){
        case "enregistrer"  :
        case "modifier"     :
        case "enlever"      :
            afficherMessage(xmlReponse.getElementsByTagName('msg')[0].firstChild.nodeValue);
        break;
        case "lister"       :
            if(xmlReponse.firstChild.nodeName == 'message'){
                afficherMessage(xmlReponse.getElementsByTagName('msg')[0].firstChild.nodeValue);
            } else {
                listerVoitures(xmlReponse);
            }
    }
}