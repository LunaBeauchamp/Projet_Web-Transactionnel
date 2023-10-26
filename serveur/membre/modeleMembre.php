<?php
    declare (strict_types=1);

    require_once(__DIR__.'/../bd/connexion.inc.php');
    require_once('includes/Membre.inc.php');
    
    class DaoMembre {
        static private $modelMembre = null;
        
        private $reponse=array();
        private $connexion = null;
        
        private function __construct(){
            
        }
        
    // Retourne le singleton du modèle 
        static function  getDaoMembre():DaoMembre {
            if(self::$modelMembre == null){
                self::$modelMembre = new DaoMembre();  
            }
            return self::$modelMembre;
        }

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

        function Mdl_ListerMembresDesactives(){
            global $connexion;
            
            try{
                $requete = "SELECT * FROM membres WHERE courriel IN (SELECT courriel FROM connexion WHERE status='D')";
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $reponse = $stmt->get_result();
            } catch(Exception $e) {
                return [];
            }finally{
                return $reponse;
            }
        }

        function Mdl_ListerMembres(){
            global $connexion;
            
            try{
                $requete = "SELECT membres.*, connexion.status FROM connexion INNER JOIN membres ON connexion.courriel = membres.courriel";
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $reponse = $stmt->get_result();
            } catch(Exception $e) {
                return [];
            }finally{
                return $reponse;
            }
        }

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
    }
?>
