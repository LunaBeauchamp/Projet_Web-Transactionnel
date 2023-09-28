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

        $msg = "";
        try{
            // Tester si le courriel existe déjà
            $requete = "SELECT * FROM connexion WHERE courriel=?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("s",$courriel);
            $stmt->execute();
            $reponse =   $stmt->get_result();
            if ($reponse->num_rows == 0) { // OK, courriel n'existe pas#
                $requete = "INSERT INTO connexion VAlUES (?,?,'M','A')";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("ss",$courriel,$mdp);
                $stmt->execute();

                $requete = "INSERT INTO membres (nom, prenom, courriel, genre, daten) VAlUES (?,?,?,?,?)";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("sssss",$nom,$prenom,$courriel,$genre,$daten);
                $stmt->execute();

                $msg = "Le membre à été bien enregistré !!!";
            } else { // Courriel existe déjà
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