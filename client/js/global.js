let validerFormEnreg = () => {
    let etat = true;
    const mdp = document.getElementById('mdp').value;
    const mdpc = document.getElementById('mdpConfirmer').value;
    const msgPass = document.getElementById('msgPass');
    
    if (mdp !== mdpc) {
        etat = false;
        msgPass.innerHTML = "Les mots de passe ne sont pas égaux !";
        setTimeout(() => {
            msgPass.innerHTML = "";
        }, 3000);
    }

    return etat;
}

let montrerToast = (msg) =>{
	if(msg.length > 0){
		let textToast = document.getElementById("textToast");
		var toastElList = [].slice.call(document.querySelectorAll('.toast'))
		var toastList = toastElList.map(function (toastEl) {
			return new bootstrap.Toast(toastEl)
		})
		textToast.innerHTML = msg;
		toastList[0].show();
	}
}
