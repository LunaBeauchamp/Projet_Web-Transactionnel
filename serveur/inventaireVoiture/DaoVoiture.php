<?php
    declare (strict_types=1);

    require_once(__DIR__.'/../bd/connexion.inc.php');
    require_once('includes/Voiture.inc.php');
    
    class DaoVoiture {
        static private $modelVoiture = null;
        
        private $reponse=array();
        private $connexion = null;
        
        private function __construct(){
            
        }
        
    // Retourne le singleton du modèle 
        static function  getDaoVoiture():DaoVoiture {
            if(self::$modelVoiture == null){
                self::$modelVoiture = new DaoVoiture();  
            }
            return self::$modelVoiture;
        }
    
        function genererDonneesXML($stmt, $root, $entite):SimpleXMLElement {
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>'.$root); // Crée $xml -> <voitures>
            $reponse = $stmt->get_result();
            while($ligne = $reponse->fetch_object()){
                $voiture = $xml->addChild($entite); // <voitures> <voiture>
                foreach ($ligne as $colonne => $valeur) {
                    $voiture->addChild($colonne, $valeur."");// Faut que $value soit string
                                                        //     <voitures><voiture><idf>123</idf>
                                                        //     <voitures><voiture><idf>123</idf><titre>James Cameron</titre>      
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
        
        function MdlV_Enregistrer(Voiture $voiture):string {
           
            $connexion =  Connexion::getConnexion();
            
            $requette="INSERT INTO inventaireVoiture VALUES(0,?,?,?,?,?)";
            try{
                $donnees = [$voiture->getNomVoiture(),$voiture->getDescription(),$voiture->getImage(),$voiture->getPrix(),$voiture->getQuantité()];
                $stmt = $connexion->prepare($requette);
                $stmt->execute($donnees);
                $xml = $this->genererMessageXML("Voiture bien enregistré");
            }catch (Exception $e){
                $xml = $this->genererMessageXML("Probléme pour enregistrer le voiture");
            }finally {
              unset($connexion);
              Header('Content-type: text/xml');
              return $xml->asXML(); // Comme json_encode, c'està dire convertir en string
            }
        }
        
        function MdlV_GetAll(){
            global $connexion;
            try{
                $requete = "SELECT * FROM inventaireVoiture";
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $xml = $this->genererDonneesXML($stmt, '<voitures/>', 'voiture'); 
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Problème pour obtenir les données des voitures");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }
        function Mdl_GetAll(){
            global $connexion;
            try{
                $requete = "SELECT * FROM inventaireVoiture";
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $reponse = $stmt->get_result();
            } catch(Exception $e) {
                return [];
            }finally{
                return $reponse;
            }
        }
    }
?>