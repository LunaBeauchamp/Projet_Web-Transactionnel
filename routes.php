<?php
    // Au début de PHP: Déclarer les types dans les paramétres des fonctions
    declare (strict_types=1);

    require_once(__DIR__."/serveur/inventaireVoiture/ControleurVoiture.php");
   
    $instanceCtr = ControleurVoiture::getControleurVoiture();
    echo $instanceCtr->CtrV_Actions();
?>