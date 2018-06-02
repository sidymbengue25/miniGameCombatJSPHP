<?php
require 'gameRouter.php';
$all=$manager->getAll();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="app.js" async></script>
  <title>Mini jeu de combat</title>
</head>
<body>
  <div class="main-content1 col-md-8 col-md-offset-2">
    <h1>Mini game de combat</h1>
    <button id='choosePersonnage' class="btn btn-success choices">Choisir un combattant</button>
    <button id="createPersonnage" class="btn btn-warning choices">Créer mon propre combattant</button><br><br>
    <div class="form-group choose hidden">
      <select class="select form-control">
        <?php
          for($i=0;$i<count($all);$i++) {?>
            <option value="<?=$all[$i]->getId()?>"><?=$all[$i]->getNom()?></option>
         <?php } ?>
      </select><button id="chooseThis" class="btn btn-default">Choisir</button>
    </div>
    <div class="form-group create hidden">
      <input class="form-control" type="text" name="nom" id="nom" value="" placeholder="nom de ton character">
      <button id="createMine" class="btn btn-default">Créer</button>
    </div>
  </div>
  <div class="main-content2 col-md-8 col-md-offset-2 hidden">
    <h1>Mini game de combat</h1>
      <button id="" class="myCharacter btn btn-info">Tu es </button><br><br>
      <div class="ennemiSelectArea">
        <select class="ennemi form-control">
          <?php
            for($i=0;$i<count($all);$i++) {?>
              <option value="<?=$all[$i]->getId()?>"><?=$all[$i]->getNom()?></option>
           <?php } ?>
        </select>
        <button id="chooseEnnemi" class="btn btn-danger">Choisir ton adversaire</button>
      </div>
    </div>
  </div>
</body>
</html>
