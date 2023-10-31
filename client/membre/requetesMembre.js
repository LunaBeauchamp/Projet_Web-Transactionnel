
let makeListeMembre =(xmlReponse) =>{
listeMembres=[];
liste = xmlReponse.getElementsByTagName('membre');
for (let unMembre of liste){
    if (unMembre.nodeName != "<membres>"){
        listeMembres.push({
            idm :unMembre.getElementsByTagName('idm')[0].firstChild.nodeValue,
            nom :unMembre.getElementsByTagName('nom')[0].firstChild.nodeValue,
            prenom: unMembre.getElementsByTagName('prenom')[0].firstChild.nodeValue,
            courriel:unMembre.getElementsByTagName('courriel')[0].firstChild.nodeValue,
            genre:unMembre.getElementsByTagName('genre')[0].firstChild.nodeValue,
            daten:unMembre.getElementsByTagName('daten')[0].firstChild.nodeValue
        })
        
    }
} 
return listeMembres;
}

let chargerMembresAJAX = () => {
$.ajax({
    type : "POST",
    url  : "../../routes.php",
    data : {"type":"membre","action":"lister"},
    dataType : "xml", //text pour voir si bien formé même chose pour xml
    success : (xmlMembre) => {//alert(xmlFilms);
        liste = makeListeMembre(xmlMembre);
        listerBouton(liste);
    },
    fail : (err) => {
        console.log("Erreur : "+err)
    }
})
}

let chargerMembreActifsAJAX = () => {
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : {"type":"membre",
                "action":"lister_Actif"},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlMembre) => {//alert(xmlFilms);
            liste = makeListeMembre(xmlMembre);
            lister(liste);
        },
        fail : (err) => {
            console.log("Erreur : "+err)
        }
    })
    }

let chargerMembreDesactiversAJAX = () => {
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : {"type":"membre","action":"lister_desactiver"},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlMembre) => {//alert(xmlFilms);
            liste = makeListeMembre(xmlMembre);
            lister(liste);
        },
        fail : (err) => {
            console.log("Erreur : "+err)
        }
     })
}

let modifierStatusMembreAJAX = (couriel, status) => {
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : {"type":"membre",
                "action":"modifier_status",
                "couriel" : couriel,
                "status" : status},
        contentType : false,
		processData : false,
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (reponse) => {//alert(xml);
            chargerMembresAJAX();
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}

let ajouterMembreAJAX = () => {
    let formMembre = new FormData(document.getElementById('formEnreg'));
    formMembre.append('action','enregistrer');
    formMembre.append('type','membre');
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : formMembre,
        async : false,
        cache : false,
        contentType : false,
        processData : false,
        dataType : "xml",
        success : (xmlMembre) => {
        },
        fail : (err) => {
            console.log("Erreur : "+err)
        }
    })

}
