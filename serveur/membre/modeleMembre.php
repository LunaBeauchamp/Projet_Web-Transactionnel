<?php
    require_once(__DIR__.'/../bd/connexion.inc.php');

    function Mdl_Ajouter($membre,$mdp){
        global $connexion;
        $nom = $membre->getNom(); 
        $prenom = $membre->getPrenom();
        $courriel = $membre->getCourriel();
        $genre = $membre->getGenre();
        $daten = $membre->getDaten();
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
                $msg="Membre ".$membre->getPrenom().", ".$membre->getNom()." bien enregistré.";
                $photo = chargerPhoto($nom,$prenom);
                $requete = "INSERT INTO membres VAlUES (0,?,?,?,?,?)";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("sssss",$nom,$prenom,$courriel,$genre,$daten);
                $stmt->execute();
                $idm = $connexion->insert_id;
            } else { // Courriel existe déjà
                $msg = "Ce courriel est déja utilisé !!!";
            }
        }catch(Exception $e) {
            $msg = 'Erreur : '.$e->getMessage();
        }finally{
            header("Location: ../../index.php?msg=$msg");
            exit;
        }
    }
?>