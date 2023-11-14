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

        function genererDonneesXML($reponse, $root, $entite):SimpleXMLElement {
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>'.$root); // Crée $xml -> <voitures>
                while($ligne = $reponse->fetch_object()){
                    $voiture = $xml->addChild($entite); // <voitures> <voiture>
                    foreach ($ligne as $colonne => $valeur) {
                        $voiture->addChild($colonne, $valeur."");// Faut que $value soit string
                    }
                } 
            echo $xml;
            return $xml;
            
        }

        function genererMessageXML($msg){
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><message/>'); //<message>
            $xml->addChild('msg',$msg);//<message><msg>voiture bien enregistré
            return $xml;
        }

        function Mdl_AjouterMembre(Membre $membre, Connection $connection, String $confirmer_mdp){
            global $connexion;
        
            `item_number` varchar(255) NOT NULL,
            `item_name` varchar(255) NOT NULL,
            `payment_status` varchar(255) NOT NULL,
            `amount` double(10,2) NOT NULL,
            `currency` varchar(255) NOT NULL,
            `txn_id` varchar(255) NOT NULL,
        
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
        
                        $requete = "INSERT INTO payment_info  VALUES (0,?,?,?,?,?,?)";
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

    }
?>
