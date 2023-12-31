<?php
    require_once("includes/Membre.inc.php");
    require_once("modeleMembre.php");

    class ControleurMembre { 
    static private $instanceCtr = null;

    private $reponse;

    private function __construct(){}

    static function  getControleurMembre():ControleurMembre{
		if(self::$instanceCtr == null){
			self::$instanceCtr = new ControleurMembre();  
		}
		return self::$instanceCtr;
	}

    function CtrM_Enregistrer(){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $courriel = $_POST['courriel'];
        $genre = $_POST['genre'];
        $daten = $_POST['date'];
        $mdp = $_POST['mdp'];
        $confirmer_mdp = $_POST['mdpConfirmer'];

        $membre = new Membre(0,$nom,$prenom,$courriel,$genre,$daten);
        $connection = new Connection($courriel,$mdp,"M","A");
        return DaoMembre::getDaoMembre()->Mdl_AjouterMembre($membre, $connection,$confirmer_mdp); 
    }

    function CtrM_Lister_Actif(){
        return DaoMembre::getDaoMembre()->Mdl_ListerMembresActif(); 
    }

    function CtrM_Lister_Desactiver(){
        return DaoMembre::getDaoMembre()->Mdl_ListerMembresDesactives(); 
    }

    function CtrM_Lister(){
        return DaoMembre::getDaoMembre()->Mdl_ListerMembres(); 
    }

    function CtrM_Modifier_Status(){
        $courriel = $_POST['courriel'];
        $nouveauStatus = $_POST['status'];
        return DaoMembre::getDaoMembre()->Mdl_ModifierStatusMembre($nouveauStatus, $courriel);
    }

    function CtrM_Lister_Un(){
        $courriel = $_POST['courriel'];
        return DaoMembre::getDaoMembre()->Mdl_ListerUn($courriel);
    }
    function CtrM_Modifier(){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $courriel = $_POST['courriel'];
        $genre = $_POST['genre'];
        $daten = $_POST['date'];
        $mdp = $_POST['mdp'];
        $confirmer_mdp = $_POST['mdpConfirmer'];

        $membre = new Membre(0,$nom,$prenom,$courriel,$genre,$daten);
        return DaoMembre::getDaoMembre()->Mdl_ModifierMembre($membre, $mdp,$confirmer_mdp);
    }

    function Ctr_Actions(){
        $action=$_POST['action'];
        switch($action){
            case "enregistrer" :
                return  $this->CtrM_Enregistrer();
                break;
            case "lister_Actif" :
                return  $this->CtrM_Lister_Actif(); 
                break;
            case "lister_desactiver" :
                return  $this->CtrM_Lister_Desactiver(); 
                break;
            case "lister" :
                return $this->CtrM_Lister(); 
                break;
            case "modifier_status":
                return $this->CtrM_Modifier_Status();
                break;
            case "lister_un":
                return $this->CtrM_Lister_Un();
                break;
            case "modifier":
                return $this->CtrM_Modifier();
                break;
        }
    }

    }
?>