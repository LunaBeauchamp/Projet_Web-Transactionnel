let chargerVoituresAJAX = () => {
    $.ajax({
        type : "POST",
        url  : "routes.php",
        data : {"action":"lister"},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlFilms);
        	montrerVue("lister", xmlVoiture);
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}
let modifierVoituresAJAX = () => {
    $.ajax({
        type : "POST",
        url  : "routes.php",
        data : {"action":"modifier"},
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
        url  : "routes.php",
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
        url  : "routes.php",
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
let listerOneVoituresAJAX = () => {
    $.ajax({
        type : "POST",
        url  : "routes.php",
        data : {"action":"lister_Voiture"},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlFilms);
            montrerVue("lister", xmlVoiture);
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}