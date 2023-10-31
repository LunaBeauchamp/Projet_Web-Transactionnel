<?php
    class Connection{
        private $courriel;
        private $motdepasse;
        private $role;
        private $status;
    
        public function __construct($courriel, $motdepasse, $role, $status){
            $this->setCourriel($courriel);
            $this->setMotdepasse($motdepasse);
            $this->setRole($role);
            $this->set>Statusl($status);
        }
        // getters
        public function getMotdepasse(){return $this->motdepasse;}
        public function getRole(){return $this->role;}
        public function getCourriel() { return $this->courriel;}
        public function getStatus() { return $this->status ;}
        // setters
        public function setMotdepasse($motdepasse) {
            $this->motdepasse = $motdepasse;
        }

        public function setRole($role){
            $this->role=$role;
        }

        public function setCourriel($courriel){
            $this->courriel=$courriel;
        }

        public function setStatus($status){
            $this->status=$status;
        }
        
        public function setDaten($daten){
            $this->daten=$daten;
        }
        
        public function afficher(){
            $rep = "".$this->motdepasse."  ".$this->role."  ".$this->courriel."  ";
            $rep .= $status;
            return $rep;
        }
    }
?>