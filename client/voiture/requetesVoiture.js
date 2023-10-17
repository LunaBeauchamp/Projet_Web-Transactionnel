let listeVoitures=[];
let makeListe =(xmlReponse) =>{
    liste = xmlReponse.getElementsByTagName('voiture');
    for (let uneVoiture of liste){
        if (uneVoiture.nodeName != "<voitures>"){
            listeVoitures.push({
                idVoiture :uneVoiture.getElementsByTagName('idVoiture')[0].firstChild.nodeValue,
                nomVoiture :uneVoiture.getElementsByTagName('nomvoiture')[0].firstChild.nodeValue,
                description: uneVoiture.getElementsByTagName('description')[0].firstChild.nodeValue,
                image:uneVoiture.getElementsByTagName('image')[0].firstChild.nodeValue,
                prix:uneVoiture.getElementsByTagName('prix')[0].firstChild.nodeValue,
                quantite:uneVoiture.getElementsByTagName('quantite')[0].firstChild.nodeValue
            })
        }
    } 
}

let chargerVoituresAJAX = (mode, chemin) => {
    $.ajax({
        type : "POST",
        url  : chemin,
        data : {"action":"lister"},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlFilms);
            makeListe(xmlVoiture);
            switch(mode){
                case "cards":
                    montrerVue("lister_cards", xmlVoiture);
                    break;
                case "table":
                    montrerVue("lister_table", xmlVoiture);
                    break;
            }
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}
let modifierVoituresAJAX = (id) => {
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : {"action":"modifier",
            "idVoiture":id},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlFilms);
            montrerVue('enlever',xmlVoiture)
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}
let supprimerVoituresAJAX = () => {
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : {"action":"enlever"},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlFilms);
            montrerVue('enlever',xmlVoiture)
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}
let ajouterVoituresAJAX = () => {
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : {"action":"enregistrer"},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlFilms);
            montrerVue('enlever',xmlVoiture)
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}
function listerOneVoituresAJAX (id) {
    
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : {"action":"lister_Voiture",
                "idVoiture":id},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlFilms);
            liste = xmlVoiture.getElementsByTagName('voiture');
        for (let uneVoiture of liste){
                voiture ={
                idVoiture :uneVoiture.getElementsByTagName('idVoiture')[0].firstChild.nodeValue,
                nomVoiture :uneVoiture.getElementsByTagName('nomvoiture')[0].firstChild.nodeValue,
                description: uneVoiture.getElementsByTagName('description')[0].firstChild.nodeValue,
                image:uneVoiture.getElementsByTagName('image')[0].firstChild.nodeValue,
                prix:uneVoiture.getElementsByTagName('prix')[0].firstChild.nodeValue,
                quantite:uneVoiture.getElementsByTagName('quantite')[0].firstChild.nodeValue
                }
            montrerFormModif(voiture)
        } 
        return voiture
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}