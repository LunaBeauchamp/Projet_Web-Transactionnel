<?php
    require_once(__DIR__.'/../env/env.inc.php');
    $connexion = new mysqli(SERVEUR,USAGER,MDP,BD);
    if($connexion->connect_errno) {
        echo "Probléme de connexion au serveur de bd";
        exit();
    }
?>