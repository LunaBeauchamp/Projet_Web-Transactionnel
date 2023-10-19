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
    id= parseInt(id)

    let formFilm = new FormData(document.getElementById('formModif'));
	formFilm.append('action','modifier');
    formFilm.append('idVoiture',id);
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : formFilm,
        contentType : false,
		processData : false,
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlVoiture);
            // console.log(xmlVoiture);
            montrerVue('enlever',xmlVoiture)
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}
let supprimerVoituresAJAX = (id) => {
    id= parseInt(id)
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : {"action":"enlever",
                "idVoiture":id},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlFilms);
            location.reload()
            montrerVue('enlever',xmlVoiture)

            // chargerVoituresAJAX('table','../../routes.php');
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}
let ajouterVoituresAJAX = () => {
    let formVoiture = new FormData(document.getElementById('formEnreg'));
	formVoiture.append('action','enregistrer');
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : formVoiture,
        contentType : false,
		processData : false,
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {
            chargerVoituresAJAX('table','../../routes.php');
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
let chercherVoituresAJAX = () => {
    let mot = document.getElementById("chercher").value
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data:{"action":"chercher_Voiture",
                "mot":mot},
        contentType : false,
		processData : false,
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {
            chargerVoituresAJAX('table','../../routes.php');
            montrerVue('enlever',xmlVoiture)
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}