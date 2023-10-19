<?php
    require_once(__DIR__.'/../bd/connexion.inc.php');

    function Mdl_ListerMembres(){
        global $connexion;
        
        try{
            $requete = "SELECT membres.*, connexion.status FROM connexion INNER JOIN membres ON connexion.courriel = membres.courriel";
            $stmt = $connexion->prepare($requete);
            $stmt->execute();
            $reponse = $stmt->get_result();
        } catch(Exception $e) {
            return [];
        }finally{
            return $reponse;
        }
    }
?>