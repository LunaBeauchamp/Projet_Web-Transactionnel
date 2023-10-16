<?php
    session_start();
    require_once(__DIR__.'/../bd/connexion.inc.php');

    function Mdl_AjouterMembre(){
        $connexion =  Connexion::getConnexion();

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $courriel = $_POST['courriel'];
        $genre = $_POST['genre'];
        $daten = $_POST['date'];
        $mdp = $_POST['mdp'];

        $msg = "";
        try{
            $requete = "SELECT * FROM connexion WHERE courriel=?";
            $stmt = $connexion->prepare($requete);
            $donnees = [$courriel];
            $stmt->execute($donnees);
            $reponse =   $stmt->get_result();
            if ($reponse->num_rows == 0) { 
                $requete = "INSERT INTO connexion VAlUES (?,?,?,?)";
                $stmt = $connexion->prepare($requete);
                $donnees = [$courriel,$mdp,'M','A'];
                $stmt->execute($donnees);

                $requete = "INSERT INTO membres VAlUES (?,?,?,?,?)";
                $stmt = $connexion->prepare($requete);
                $donnees = [$nom,$prenom,$courriel,$genre,$daten];
                $stmt->execute($donnees);

                $msg = "Le membre à été bien enregistré !!!";
            } else {
                $msg = "Ce courriel est déjà utilisé !!!";
            }
        }catch(Exception $e) {
            $msg = 'Erreur : '.$e->getMessage();
        }finally{
            header("Location: ../../index.php?msg=$msg");
            exit;
        }
    }
    Mdl_AjouterMembre();
?>