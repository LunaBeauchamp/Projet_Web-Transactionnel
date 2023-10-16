let chargerVoituresAJAX = () => {
    $.ajax({
        type : "POST",
        url  : "routes.php",
        data : {"action":"lister"},
        dataType : "xml", //text pour voir si bien formé même chose pour xml
        success : (xmlVoiture) => {//alert(xmlFilms);
            console.log(xmlVoiture)
        	montrerVue("lister", xmlVoiture);
        },
        fail : (err) => {
           console.log("Erreur : "+err)
        }
    })
}