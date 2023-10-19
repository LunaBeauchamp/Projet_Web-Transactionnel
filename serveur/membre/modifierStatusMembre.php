<?php
require_once(__DIR__.'/../bd/connexion.inc.php');

function Mdl_ModifierStatusMembre($nouveauStatus, $courriel) {
    global $connexion;

    $msg = "";

    try {
        $requete = "UPDATE connexion SET status = ? WHERE courriel = ?";
        $stmt = $connexion->prepare($requete);
        
        if ($stmt) {
            $stmt->bind_param("ss", $nouveauStatus, $courriel);
            $stmt->execute();
        }
    } catch (Exception $e) {
        $msg = 'Erreur : ' . $e->getMessage();
    }finally{
        header("Location: page_listerTousLesMembres.php");
            exit;
    }
}

if (isset($_GET['courriel']) && isset($_GET['status'])) {
    $courriel = $_GET['courriel'];
    $nouveauStatus = $_GET['status'];

    Mdl_ModifierStatusMembre($nouveauStatus, $courriel);
}

?>
