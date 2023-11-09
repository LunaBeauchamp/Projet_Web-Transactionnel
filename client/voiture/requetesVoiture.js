let listeVoitures;
let makeListe =(xmlReponse) =>{
listeVoitures=[];
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
    data : {"type":"voiture","action":"lister"},
    dataType : "xml", //text pour voir si bien formé même chose pour xml
    success : (xmlVoiture) => {
        //alert(xmlVoiture);
        makeListe(xmlVoiture);
        switch(mode){
            case "cards":
                montrerVue("lister_cards", xmlVoiture);
                break;
            case "table":
                montrerVue("lister_table", xmlVoiture);
                break;
            case "silence":
                // seulement loader la liste
                break;
        }
    },
    fail : (err) => {
        console.log("Erreur : "+err)
    }
})
}

let modifierVoituresAJAX = (id,image) => {
    id = parseInt(id);
    let formVoiture = new FormData(document.getElementById('formModif'));
	formVoiture.append('action','modifier');
    formVoiture.append('idVoiture',id);
    formVoiture.append('vieilleImage',image);
    formVoiture.append('type','voiture');
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : formVoiture,
        processData: false,
        contentType: false,
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {
            alert(xmlVoiture);
            montrerVue('enlever',xmlVoiture)
            chargerVoituresAJAX('table','../../routes.php');
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}
let supprimerVoituresAJAX = (id) => {

    const toast = document.querySelector('.toast');
    const yesButton = document.getElementById('yesButton');
    const cancelButton = document.getElementById('cancelButton');

    let aSupprimer = false;

    function showToast() {
        $(toast).toast('show');
    }

    function hideToast() {
        $(toast).toast('hide');
    }

    yesButton.addEventListener('click', () => {
        id= parseInt(id)
        $.ajax({
            type : "POST",
            url  : "../../routes.php",
            data : {"type":"voiture","action":"enlever",
                    "idVoiture":id},
            dataType : "xml",
            success : (xmlVoiture) => {
                montrerVue('enlever',xmlVoiture)
                chargerVoituresAJAX('table','../../routes.php');
            },
            fail : (err) => {
            console.log("Erreur : "+err)
            }
        })
        hideToast();
    });

    cancelButton.addEventListener('click', () => {
        aSupprimer = false
        hideToast();
    });

    showToast();


}
let ajouterVoituresAJAX = () => {
    let formVoiture = new FormData(document.getElementById('formEnreg'));
    formVoiture.append('action','enregistrer');
    formVoiture.append('type','voiture');
    $.ajax({
        type : "POST",
        url  : "../../routes.php",
        data : formVoiture,
        dataType : "xml",
        processData: false,
        contentType: false,
        
        success : (xmlVoiture) => {
            // alert(xmlVoiture)
            $('#enregModal').modal('hide');
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
    data : {"type":"voiture","action":"lister_Voiture",
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
    data : {"type":"voiture","action":"chercher_Voiture",
            "mot":mot},
    dataType : "xml", //text pour voir si bien formé même chose pour xml
    success : (xmlVoiture) => {
        makeListe(xmlVoiture);
        montrerVue("lister_table", xmlVoiture);
    },
    fail : (err) => {
        console.log("Erreur : "+err)
    }
})
}