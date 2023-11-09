<?php
    // Au début de PHP: Déclarer les types dans les paramétres des fonctions
    declare (strict_types=1);

    require_once(__DIR__."/serveur/inventaireVoiture/ControleurVoiture.php");
    require_once(__DIR__."/serveur/membre/controleurMembre.php");
   
    $type=$_POST['type'];
    $instanceCtr=null;
        switch($type){
            case "membre":
                $instanceCtr = ControleurMembre::getControleurMembre();
                break;
            case "voiture":
                $instanceCtr = ControleurVoiture::getControleurVoiture();
                break;
        }
    echo $instanceCtr->Ctr_Actions();
?>