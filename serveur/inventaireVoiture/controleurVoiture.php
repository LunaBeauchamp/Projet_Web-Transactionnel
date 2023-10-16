<?php
       
    require_once("includes/Voiture.inc.php");
    require_once("DaoVoiture.php");

 class ControleurVoiture { 
    static private $instanceCtr = null;
    
    private $reponse;

    private function __construct(){

    }

     // Retourne le singleton du modèle 
	static function  getControleurVoiture():ControleurVoiture{
		if(self::$instanceCtr == null){
			self::$instanceCtr = new ControleurVoiture();  
		}
		return self::$instanceCtr;
	}

	function CtrV_Enregistrer(){
         $voiture = new Voiture(0,$_POST['nomVoiture'], (int)$_POST['description'],"Image", $_POST['prix'], $_POST['quantite']);
         return DaoVoiture::getDaoVoiture()->MdlV_Enregistrer($voiture); 
    }

    function CtrV_getAll(){
         return DaoVoiture::getDaoVoiture()->MdlV_GetAll(); 
    }

    function CtrV_Actions(){
        $action=$_POST['action'];
        switch($action){
            case "enregistrer" :
                return  $this->CtrV_Enregistrer();
            case "fiche" :
                //fiche(); 
            break;
            case "modifier" :
                //return  $this->CtrV_Modifierr(); 
            break;
            case "enlever" :
                //return  $this->CtrV_Suprimmer(); 
            break;
            case "lister" :
                return $this->CtrV_getAll(); 
        }
        // Retour de la réponse au client
       
    }
}
?>