<?php
/**
 * Pour gérer le combat et les enregistrement ds le BDD
 */
class ManagerPersonnage
{
  private $_db;
  function __construct(PDO $db)
  {
    $this->setDb($db);
  }
  /**
   * connexion à la BDD
   */
  public function setDb($db){$this->_db=$db;}
  /**
   * Ajouter un personnage à la BDD
   * @param Personnage $perso instabce d'objet
   */
  public function add(Personnage $perso)
  {
    $q=$this->_db->prepare('INSERT INTO personnages SET nom=:nom,degats=:degats');
    $q->bindValue(':nom',$perso->getNom());
    $q->bindValue(':degats',0);
    $q->execute();
  }
  /**
   * Elle permet de recupérer un personnage dans la BDD
   * @param  [number] $id identifiant du personnage à ecupérer
   * @return [object]     un instance de Personnage
   */
  public function get($id)
  {
    $q=$this->_db->query('SELECT * from personnages where id='.$id);
      while ($donnee=$q->fetch(PDO::FETCH_ASSOC)) {
        return new Personnage($donnee);
    }
  }
  /**
   * Elle permet de recupérer tous les personnages dans la BDD
   * @return [array] chaque élément est un instance de Personnage
   */
  public function getAll()
  {
    $q=$this->_db->query('SELECT * from personnages');
    while ($donnees=$q->fetch(PDO::FETCH_ASSOC)) {
      $persos[]=new Personnage($donnees);
    }
    return $persos;
  }
  /**
   * Mettre à jour les données d'un Personnage
   * @param  Personnage $perso [object]
   */
  public function update(Personnage $perso)
  {
    $q=$this->_db->prepare('UPDATE personnages SET degats=:degats where id=:id');
    $q->bindValue(':degats',$perso->getDegats());
    $q->bindValue(':id',$perso->getId());
    $q->execute();
  }
  /**
   * Supprimer un personnage dans la BDD
   * @param  Personnage $perso [object]
   */
  public function delete(Personnage $perso)
  {
    $q=$this->_db->prepare('DELETE personnages where id=:id');
    $q->bindValue(':id',$perso->getId());
    $q->execute();
    echo $perso->getName().' est mort';
  }
}
?>
