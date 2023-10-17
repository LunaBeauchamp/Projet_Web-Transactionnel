<?php
declare (strict_types=1);

class Voiture {
    private $idV;
    private $nomVoiture;
    private $description;
    private $image;
    private $prix;
    private $quantite;

    function __construct(int $idV, string $nomVoiture, string $description, string $image, int $prix, int $quantite) {
        $this->setIdv($idV);
        $this->setNomVoiture($nomVoiture);
        $this->setDescription($description);
        $this->setImage($image);
        $this->setPrix($prix);
        $this->setQuantite($quantite);
    }

    function getIdV():int {
        return $this->idV;
    }
    function getNomVoiture():string {
        return $this->nomVoiture;
    }
    function getDescription():int {
        return $this->description;
    }
    function getImage():string {
        return $this->image;
    }
    function getPrix():int {
        return $this->prix;
    }
    function getQuantite():int {
        return $this->quantite;
    }

    function setIdv($idV):void {
        if($idV > 0){
            $this->idV = $idV;
        }
    }
    function setNomVoiture($nomVoiture):void {
        $this->nomVoiture = $nomVoiture;
    }
    function setDescription($description):void {
        $this->description = $description;
    }
    function setImage($image):void {
        $this->image = $image;
    }
    function setPrix($prix):void {
        $this->prix = $prix;
    }
    function setQuantite($quantite):void {
        $this->quantite = $quantite;
    }
}
?>