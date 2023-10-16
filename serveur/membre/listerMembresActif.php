<?php
    require_once(__DIR__.'/../bd/connexion.inc.php');

    function Mdl_ListerMembresActif(){
        global $connexion;
        
        try{
            $requete = "SELECT * FROM membres WHERE courriel IN (SELECT courriel FROM connexion WHERE status='A')";
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