<?php
    require_once(__DIR__.'/../bd/connexion.inc.php');

    function Mdl_GetAll(){
        global $connexion;
        try{
            $requete = "SELECT * FROM inventaireVoiture";
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