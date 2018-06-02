<?php
/**
 * Copyright Mai 2018 -- Sidy Mbengue email:sidymbengue25@gmail.com
 * compte github : https://github.com/sidymbengue25
 */

/**
 * class Personnage de jeu : elle permet de visualiser les infos des personnages
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
  /**
   * Elle permet l'hydration de l'objet
   * @param  [array] $donnees
   */
  public function hydrate($donnees)
  {
    foreach ($donnees as $key => $value) {
      $method='set'.ucfirst($key);
      if(method_exists($this, $method)){
        $this->$method($value);
      }
    }
  }
  //Les Getters
  public function getId(){return $this->_id;}
  public function getNom(){return $this->_nom;}
  public function getDegats(){return $this->_degats;}
  //Les Setters
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
    $this->_degats+=$degats;
  }
}
?>
