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
            global $connexion;
            $msg = "";
            $nom =$voiture->getNomVoiture();
            $description=$voiture->getDescription();
            $pochette=$this->verserFichier("pochettes", "image", "voiture.jpg",$nom);
            $msg = "fonctionne";
            $prix=$voiture->getPrix();
            $quantite=$voiture->getQuantite();
            $msg = $msg."attribut   ";
            try{
                $requette="INSERT INTO inventaireVoiture VALUES(0,?,?,?,?,?)";
                $stmt = $connexion->prepare($requette);
                $msg = "préparer";
                $stmt->bind_param("sssii",$nom,$description, $pochette, $prix, $quantite);
                $msg = "bind";
                $stmt->execute();
                $msg = "execute";
                $xml = $this->genererMessageXML("Voiture enregistrer");

                
            }catch (Exception $e){
                $xml = $this->genererMessageXML("Probléme pour enregistrer le voiture");
            }finally {
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }
        function MdlV_Modifier(Voiture $newVoiture){
            global $connexion;
            $nom =$newVoiture->getNomVoiture();
            $description=$newVoiture->getDescription();
            $image=$this->verserFichier("pochettes", "image", $newVoiture->getImage(),$nom);
            $prix=$newVoiture->getPrix();
            $quantite=$newVoiture->getQuantite();
            $idV=$newVoiture->getIdV();
            try{
                $requete = "UPDATE inventaireVoiture set nomVoiture=?, description=?, image=?, prix=?, quantite=? WHERE idVoiture = ?";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("sssiii",$nom,$description, $image, $prix, $quantite, $idV);
                $stmt->execute();
                $reponse = $stmt->get_result();
                $xml = $this->genererMessageXML("Voiture modifier.");
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Problème pour modifier la voiture.");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }
        function MdlV_Supprimer($idV){
            global $connexion;
            try{
                $requete = "DELETE FROM `inventaireVoiture` WHERE idVoiture = ?";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("i",$idV);
                $stmt->execute();
                $reponse = $stmt->get_result();
                $xml = $this->genererMessageXML("Voiture supprimer.");
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Problème pour suprimer la voiture.");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }
        function MdlV_GetOne($idV){
            global $connexion;
            try{
                $requete = "SELECT * FROM inventaireVoiture where idVoiture = ?";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("i",$idV);
                $stmt->execute();
                $xml = $this->genererDonneesXML($stmt, '<voitures/>', 'voiture'); 
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Problème pour obtenir les données de la voiture");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
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
        function MdlV_Chercher($selection){
            global $connexion;
            try{
                $requete = "SELECT * FROM inventaireVoiture WHERE nomVoiture LIKE '%".$selection."%'";
                $stmt = $connexion->prepare($requete);
                $stmt->execute();
                $xml = $this->genererDonneesXML($stmt, '<voitures/>', 'voiture'); 
                $msg = "génération";
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Problème pour obtenir les données des voitures");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }

        function verserFichier($dossier, $inputNom, $fichierDefaut, $chaine){
            $cheminDossier=__DIR__."/../pochettes/";
            $pochette=$fichierDefaut;
            if($_FILES["image"]['tmp_name']!==""){
                $nomPochette=sha1($chaine.time());
                if($pochette !== "voiture.jpg"){
                    $this->enleverFichier($dossier,$pochette);// Cas enlever et modifier
                }
                //Upload de la photo
                $tmp = $_FILES["image"]['tmp_name'];
                $fichier= $_FILES["image"]['name'];
                $extension=strrchr($fichier,'.');
                move_uploaded_file($tmp, $cheminDossier.$nomPochette.$extension);
                $pochette=$nomPochette.$extension;
            }
            return $pochette;
        }
        function enleverFichier($dossier,$pochette){
            if($pochette!=="voiture.jpg"){ // Voir fichier env.inc.php
                $rmPoc=__DIR__."/../pochettes/".$pochette;
                $tabFichiers = glob(__DIR__."/../pochettes/*");
                // Parcourir les fichier
                foreach($tabFichiers as $fichier){
                if(is_file($fichier) && $fichier==trim($rmPoc)) {
                    // Enlever le fichier
                    unlink($fichier);
                    break;
                }
                }
            }
        }
        function MdlV_Payer($selection){
            global $connexion;
            try{
                foreach ($selection as $idv){
                    //trouver la quantite de l'élément
                    $idv = (int) $idv;
                $requete = "SELECT quantite FROM inventaireVoiture where idVoiture = ?";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("i", $idv);
                $stmt->execute();
                $reponse = $stmt->get_result();
                //$xml = $this->genererDonneesXML($stmt, '<voitures/>', 'voiture'); 
                $ligne = $reponse->fetch_object();
                $quantite = $ligne->quantite -1;
                //updater la base de donner
                $requete = "UPDATE inventaireVoiture set quantite=? WHERE idVoiture = ?";
                $stmt = $connexion->prepare($requete);
                $stmt->bind_param("ii",$quantite, $idv);
                $stmt->execute();
                $reponse = $stmt->get_result();
                $xml = $this->genererMessageXML("changement enregistrer");
                }
            } catch(Exception $e) {
                $xml = $this->genererMessageXML("Problème pour obtenir les données des voitures");
            }finally{
                Header('Content-type: text/xml');
                return $xml->asXML();
            }
        }
    }
?>