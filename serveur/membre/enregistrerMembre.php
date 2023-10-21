<?php
session_start();
require_once(__DIR__.'/../bd/connexion.inc.php');

function Mdl_AjouterMembre(){
    global $connexion;

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $courriel = $_POST['courriel'];
    $genre = $_POST['genre'];
    $daten = $_POST['date'];
    $mdp = $_POST['mdp'];
    $confirmer_mdp = $_POST['mdpConfirmer'];

    $msg = "";

    try {
        if ($mdp === $confirmer_mdp) {
            $requete = "SELECT * FROM connexion WHERE courriel=?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("s", $courriel);
            $stmt->execute();
            $reponse = $stmt->get_result();
            if ($reponse->num_rows == 0) {
                $requete = "INSERT INTO connexion VALUES (?,?,'M','A')";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("ss", $courriel, $mdp);
                $stmt->execute();

                $requete = "INSERT INTO membres (nom, prenom, courriel, genre, daten) VALUES (?,?,?,?,?)";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("sssss", $nom, $prenom, $courriel, $genre, $daten);
                $stmt->execute();

                $msg = "Le membre a été bien enregistré !!!";
            } else {
                $msg = "Ce courriel est déjà utilisé !!!";
            }
        } else {
            $msg = "La confirmation de mot de passe ne correspond pas au mot de passe entré. Veuillez essayer à nouveau SVP.";
        }
    } catch (Exception $e) {
        $msg = 'Erreur : ' . $e->getMessage();
    } finally {
        header("Location: ../../index.php?msg=$msg");
        exit;
    }
}

Mdl_AjouterMembre();
?>
