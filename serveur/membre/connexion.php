<?php
    session_start();
    require_once(__DIR__.'/../bd/connexion.inc.php');

    

    function Mdl_Connexion(){
        global $connexion;
        $courriel = $_POST['courriel'];
        $mdp = $_POST['mdp'];
        try{
            $requete = "SELECT * FROM connexion WHERE courriel=? AND motdepasse=?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("ss", $courriel, $mdp);
            $stmt ->execute();
            $reponse = $stmt->get_result();
            if ($reponse->num_rows > 0) {
                $ligne = $reponse->fetch_object();
                if($ligne->role == 'M'){
                    $_SESSION['role'] = 'M';
                    header('Location: membre.php');
                    exit();
                } else {
                    $_SESSION['role'] = 'A';
                    header('Location: ../admin/admin.php');
                    exit();
                }
            }
            // else{
            //     header("Location: ../../index.php?msg=$msg");//changer pour connexion quand implémenter
            // exit;
            // }
        } catch(Exception $e) {
            $msg = 'Erreur : '.$e->getMessage();
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