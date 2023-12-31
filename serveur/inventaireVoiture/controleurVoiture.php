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
        $voiture = new Voiture(0,$_POST['nomVoiture'], $_POST['description'],"pochette", (int)$_POST['prix'], (int)$_POST['quantite']);
        return DaoVoiture::getDaoVoiture()->MdlV_Enregistrer($voiture); 

    }
    function CtrV_Modifier(){
        $voiture = new Voiture((int)$_POST['idVoiture'],$_POST['nomVoiture'], $_POST['description'],$_POST['vieilleImage'], (int)$_POST['prix'], (int)$_POST['quantite']);
        return DaoVoiture::getDaoVoiture()->MdlV_Modifier($voiture); 
   }

   function CtrV_Supprimer(){
    $idV = $_POST['idVoiture'];
    return DaoVoiture::getDaoVoiture()->MdlV_Supprimer($idV); 
    }
    function CtrV_getOne(){
        $idV = $_POST['idVoiture'];
        return DaoVoiture::getDaoVoiture()->MdlV_GetOne($idV); 
    }
    function CtrV_getAll(){
         return DaoVoiture::getDaoVoiture()->MdlV_GetAll(); 
    }
    function CtrV_chercher(){
        $selection = $_POST['mot'];
        return DaoVoiture::getDaoVoiture()->MdlV_Chercher($selection); 
   }
   function CtrV_Payer(){
        $selection = json_decode($_POST['data']);
        return DaoVoiture::getDaoVoiture()->MdlV_Payer($selection); 
    }

    function Ctr_Actions(){
        $action=$_POST['action'];
        switch($action){
            case "enregistrer" :
                return  $this->CtrV_Enregistrer();
                break;
            case "modifier" :
                return  $this->CtrV_Modifier(); 
                break;
            case "enlever" :
                return  $this->CtrV_Supprimer(); 
                break;
            case "lister" :
                return $this->CtrV_getAll(); 
                break;
            case "chercher_Voiture":
                return $this->CtrV_chercher();
                break;
            case "lister_Voiture" :
                return $this->CtrV_getOne(); 
                break;
            case "payer" :
                return $this->CtrV_Payer(); 
                break;
            default:
            return DaoVoiture::getDaoVoiture()->genererMessageXML("erreur default");
        }
    }
}
?>