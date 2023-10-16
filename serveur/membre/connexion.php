<?php
    session_start();
    require_once(__DIR__.'/../bd/connexion.inc.php');

    function Mdl_Connexion(){
        $connexion =  Connexion::getConnexion();
        $courriel = $_POST['courriel'];
        $mdp = $_POST['mdp'];
        try{
            $requete = "SELECT * FROM connexion WHERE courriel=? AND motdepasse=?";
            $stmt = $connexion->prepare($requete);
            $donnees = [$courriel,$mdp];
            $stmt->execute($donnees);

            $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
            if($ligne->role == 'M'){
                $_SESSION['role'] = 'M';
                header('Location: membre.php');
                exit();
            } else {
                $_SESSION['role'] = 'A';
                header('Location: ../admin/admin.php');
                exit();
            }
            
        } catch(Exception $e) {
            echo( 'Erreur : '.$e->getMessage());
        }finally{
            header("Location: ../../index.php?msg=$msg");
            exit;
        }
    }
    
    function Mdl_DeConnexion(){
        unset($_SESSION);
        session_destroy();
        header('Location: ../../index.php');
        exit();
    }
    Mdl_Connexion()
?>