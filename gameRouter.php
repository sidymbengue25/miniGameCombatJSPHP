<?php
$db=new PDO('mysql:host=localhost;dbname=miniGameTest','root','');
function chargerClass($class){
  return require($class.'.class.php');
}
spl_autoload_register('chargerClass');
$manager=new ManagerPersonnage($db);
if(isset($_GET['attak']) and !empty($_GET['attak'])){
  $id=intval($_GET['attak']);
  $attked=$manager->get($id);
  $attked->setDegats();
  $manager->update($attked);
  $vie=100-$attked->getDegats();
  if($attked->getDegats()===100){
    $manager->delete($attked);
  }else{
    echo 'Tu lui a infligé des dégats il lui reste'.$vie.' de vie';
  }
}
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
?>
