<?php
    class Membre{
        private $idm;
        private $nom;
        private $prenom;
        private $courriel;
        private $genre;
        private $daten;
    
        public function __construct($idm, $nom,$prenom,$courriel,$genre,$daten){
            $this->setIdm($idm);
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setCourriel($courriel);
            $this->setGenre($genre);
            $this->setDaten($daten);
        }
        // getters
        public function getIdm(){return $this->idm;}
        public function getNom(){return $this->nom;}
        public function getPrenom(){return $this->prenom;}
        public function getCourriel() { return $this->courriel;}
        public function getGenre() { return $this->genre ;}
        public function getDaten()  {return $this->daten;}
        // setters
        public function setIdm($idm) {
            $this->idm = $idm;
        }

        public function setNom($nom){
            $this->nom=$nom;
        }

        public function setPrenom($prenom){
            $this->prenom=$prenom;
        }

        public function setCourriel($courriel){
            $this->courriel=$courriel;
        }

        public function setGenre($genre){
            $this->genre=$genre;
        }
        
        public function setDaten($daten){
            $this->daten=$daten;
        }
        
        public function afficher(){
            $rep = "".$this->idm."  ".$this->nom."  ".$this->prenom."  ".$this->courriel."  ";
            if ($this->genre == 'f'){
                $sexe = 'Feminin';
            } else  if ($this->genre == 'm'){
                $sexe='Masculin';
            }else  if ($this->genre == 'nd'){
                $sexe='Non Disponible';
            }else {
                $sexe='Autre';
            }
            $rep .= $sexe.'  '.$this->daten;
            return $rep;
        }
    }
?>