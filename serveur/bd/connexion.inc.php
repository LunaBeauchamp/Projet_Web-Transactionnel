<?php
declare (strict_types=1);

require_once(__DIR__.'/../env/env.inc.php');

// Patron de conception Singleton
class Connexion{
	private static $connexion=null;
	
	// Interdire de créer des objets Connexion par l'extérieur de la classe
	private function __construct(){}

	
	// Retourne le singleton de la connexion
	static function getConnexion():PDO {
		if(self::$connexion == null){
			self::connecter();
		}
		return self::$connexion;
	}
	
	// Créer la connexion
	private static function connecter():void {
		global $SERVEUR, $BD, $USAGER, $PASS; // Définies dans le fichier "env.inc.php"
		try {
			$dns = "mysql:host=$SERVEUR;dbname=$BD";
			$options = array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			self::$connexion = new PDO( $dns, $USAGER, $PASS, $options );
			} catch ( Exception $e ) {
				echo $e->getMessage();
				echo "Probleme de connexion au serveur de bd";
				exit();
			}
	}
}
?>