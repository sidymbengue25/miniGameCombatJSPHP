<?php
/**
 * Copyright Mai 2018 -- Sidy Mbengue email:sidymbengue25@gmail.com
 * compte github : https://github.com/sidymbengue25
 */

/**
 * connextion à la BDD
 * @var PDO
 */
$db=new PDO('mysql:host=localhost;dbname=miniGameTest','root','');
function chargerClass($class){
  return require($class.'.class.php');
}
spl_autoload_register('chargerClass');
$manager=new ManagerPersonnage($db);
//liste de tous les Personnages
$all=$manager->getAll();
/**
 * L'utilisteur a initialisé une requête de type 'attaque' : il a attaqué un ennemi, chaque attaque inflige un dégats de 5 à l'ennemi
 */
if(isset($_GET['attak']) and !empty($_GET['attak'])){
  $id=intval($_GET['attak']);
  $attaked=$manager->get($id);
  $attaked->setDegats(5);
  $manager->update($attaked);
  $vie=100-$attaked->getDegats();
  if($attaked->getDegats()>=100){
    $manager->delete($attaked);
    echo 'Il est mort !!!!!';
    return;
  }else{
    echo $vie;
  }
}
/**
 * L'utilisteur a initialisé une requête de type 'new' : créer son propre Joueur
 */
if(isset($_GET['new']) and !empty($_GET['new'])){
  $nom=htmlspecialchars($_GET['new']);
  $donnees=array(
    'nom'=>$nom,
    'degats'=>0
  );
  $persoReq=new Personnage($donnees);
  $manager->add($persoReq);
  $last_id = $db->lastInsertId();
  $perso=$manager->get($last_id);
  echo $perso->getNom();
}
/**
 * L'utilisteur a initialisé une requête de type 'choose' : il utilise un des joueur existant
 */
if(isset($_GET['chooseMine']) and !empty($_GET['chooseMine'])){
  $id=intval($_GET['chooseMine']);
  $myWarrior=$manager->get($id);
  echo $myWarrior->getNom();
}
?>
