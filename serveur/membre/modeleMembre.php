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
        
            $nom = $membre->getNom();
            $prenom = $membre->getPrenom();
            $courriel = $membre->getCourriel();
            $genre = $membre->getGenre();
            $daten = $membre->getDaten();
            $mdp = $connection->getMotdepasse();
        
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
                $requete = "SELECT membres.*, connexion.status FROM connexion INNER JOIN membres ON connexion.courriel = membres.courriel WHERE status='A'";
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $reponse = $stmt->get_result();
                if($reponse->num_rows == 0){
                    $xml = $this->genererMessageXML("Aucun membre trouvé.");
                }
                else{
                    $xml = $this->genererDonneesXML($reponse, '<membres/>', 'membre'); 
                }
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Probléme pour obtenir les membres");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }

        function Mdl_ListerMembresDesactives(){
            global $connexion;
            
            try{
                $requete = "SELECT membres.*, connexion.status FROM connexion INNER JOIN membres ON connexion.courriel = membres.courriel WHERE status='D'";
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $reponse = $stmt->get_result();
                if($reponse->num_rows == 0){
                    $xml = $this->genererMessageXML("Aucun membre trouvé.");
                }
                else{
                    $xml = $this->genererDonneesXML($reponse, '<membres/>', 'membre'); 
                }
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Probléme pour obtenir les membres");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }

        function Mdl_ListerMembres(){
            global $connexion;
            try{
                $requete = "SELECT membres.*, connexion.status FROM connexion INNER JOIN membres ON connexion.courriel = membres.courriel";
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $reponse = $stmt->get_result();
                if($reponse->num_rows == 0){
                    $xml = $this->genererMessageXML("Aucun membre trouvé.");
                }
                else{
                    $xml = $this->genererDonneesXML($reponse, '<membres/>', 'membre'); 
                }
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Probléme pour obtenir les membres");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
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
                    $xml = $this->genererMessageXML("Modifier avec succès.");
                }
            } catch (Exception $e) {
                $xml = $this->genererMessageXML("Probléme pour modifier le membre");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }
        function Mdl_ListerUn($courriel){
            global $connexion;
            try{
                $requete = "SELECT membres.*, connexion.motdepasse FROM connexion INNER JOIN membres ON connexion.courriel = membres.courriel WHERE membres.courriel = ?";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("s",$courriel);
                $stmt->execute();
                $reponse = $stmt->get_result();
                $xml = $this->genererDonneesXML($reponse, '<membres/>', 'membre'); 
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Probléme pour obtenir les membres");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }

        function Mdl_ModifierMembre(Membre $membreModif, String $mdpModif , String $mdpConfirm){
            try{
                $msg = "";
                $courriel = $membreModif->getCourriel();
                try{
                    global $connexion;
                    $requete = "SELECT membres.*, connexion.motdepasse FROM connexion INNER JOIN membres ON connexion.courriel = membres.courriel WHERE membres.courriel = ?";
                    $stmt = $connexion->prepare($requete);
                    $stmt->bind_param("s",$courriel);
                    $stmt->execute();
                    $reponse = $stmt->get_result();
                    $membre = $reponse->fetch_object();
                } catch(Exception $e) {
                    $msg="Probléme pour obtenir les membres";
                }
                $nom = $membreModif->getNom();
                $prenom = $membreModif->getPrenom();
                $genre = $membreModif->getGenre();
                $daten = $membreModif->getDaten();
                $identique = true;
                if (empty($mdpModif)){
                    $identique = false;
                }
                if ($identique&&strcmp($mdpModif,$mdpConfirm)!=0){
                    $msg="Mot de passe non identique";
                    $identique = false;
                    
                }
                if ($identique&&strcmp($membre->motdepasse,$mdpConfirm)==0){
                    $msg="Choisissez un nouveau mot de passe";
                    $identique = false;
                }
                if ($identique){
                    try{
                        global $connexion;
                        $msg="d";
                        $requete = "UPDATE connexion set motdepasse=? WHERE courriel=?";
                        $msg="s";
                        $stmt = $connexion->prepare($requete);
                        $msg="a";
                        $stmt->bind_param("ss",$mdpModif,$courriel);
                        $msg="gfd";
                        $stmt->execute();
                        $msg="vidgfde";
                    } catch(Exception $e) {
                        $msg="Probléme pour modifier le mot de passe";
                    }
                }
                try{
                    global $connexion;
                    $msg = "c";
                    $requete = "UPDATE membres set nom=?, prenom=?, genre=?, daten=? WHERE courriel=?";
                    $stmt = $connexion->prepare($requete);
                    $msg = "requete";
                    $msg = $nom.$prenom.$genre.$daten.$courriel;
                    $stmt->bind_param("sssss",$nom,$prenom,$genre,$daten,$courriel);
                    $msg = "binded";
                    $stmt->execute();
                    $msg="Membre modifier";
                } catch(Exception $e) {
                    $msg="Probléme pour modifier le membre";
                }
            }
            catch(Exception $e){
                $msg.=$e." :Probléme pour modifier";
            }
            finally{
                $xml=$this->genererMessageXML($msg);
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }
    }
?>
