<?php
    session_start();
    require_once(__DIR__.'/../bd/connexion.inc.php');

    function Mdl_Connexion() {
        global $connexion;
        $courriel = $_POST['courriel'];
        $mdp = $_POST['mdp'];
    
        try {
            $check_query = "SELECT courriel FROM connexion WHERE courriel=?";
            $check_stmt = $connexion->prepare($check_query);
            $check_stmt->bind_param("s", $courriel);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
    
            if ($check_result->num_rows === 0) {
                $msg = "Email not found in the database.";
                header("Location: /serveur/membre/page_connexion.php?msg=$msg");
                exit();
            }
    
            $select_query = "SELECT * FROM connexion WHERE courriel=? AND motdepasse=?";
            $stmt = $connexion->prepare($select_query);
            $stmt->bind_param("ss", $courriel, $mdp);
            $stmt->execute();
            $reponse = $stmt->get_result();
    
            if ($reponse->num_rows > 0) {
                $ligne = $reponse->fetch_object();
                if ($ligne->role == 'M') {
                    $_SESSION['role'] = 'M';
                    header('Location: membre.php');
                    exit();
                } else {
                    $_SESSION['role'] = 'A';
                    header('Location: ../admin/admin.php');
                    exit();
                }
            } else {
                $msg = "Invalid password or other error.";
                header("Location: /serveur/membre/page_connexion.php?msg=$msg");
                exit();
            }
        } catch (Exception $e) {
            $msg = 'Erreur : ' . $e->getMessage();
            header("Location: /serveur/membre/page_connexion.php?msg=$msg");
            exit();
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