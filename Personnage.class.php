<?php
/**
 * class personnage de jeu
 */
class Personnage
{
  private $_id;
  private $_nom;
  private $_degats;
  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
  }
  public function hydrate($donnees)
  {
    foreach ($donnees as $key => $value) {
      $method='set'.ucfirst($key);
      if(method_exists($this, $method)){
        $this->$method($value);
      }
    }
  }
  public function getId(){return $this->_id;}
  public function getNom(){return $this->_nom;}
  public function getDegats(){return $this->_degats;}

  public function setId($id)
  {
    $id=(int)$id;
    if (is_int($id) && $id>0) {
      $this->_id=$id;
    }
  }
  public function setNom($nom)
  {
    if (is_string($nom)) {
      $this->_nom=$nom;
    }
  }
  public function setDegats($degats){
    $degats=(int)$degats;
    if(is_int($degats)){$this->_degats+=5;}
  }
}
?>
