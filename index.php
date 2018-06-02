<?php
/**
 * Copyright Mai 2018 -- Sidy Mbengue email:sidymbengue25@gmail.com
 * compte github : https://github.com/sidymbengue25
 */

require 'gameRouter.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
  <script type="text/javascript" src="app.js" async></script>
  <title>Mini jeu de combat</title>
</head>
<body>
  <div class="main-content1 col-md-8 col-md-offset-2">
    <h1>Mini game de combat</h1>
    <button id='choosePersonnage' class="btn btn-success choices">Choisir un combattant</button>
    <button id="createPersonnage" class="btn btn-warning choices">Créer mon propre combattant</button><br><br>
    <div class="form-group choose hidden">
      <select class="select form-control" id="characterList">
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
      <button id="" class="myCharacter btn btn-info">Je suis </button><br><br>
      <div class="ennemiSelectArea">
        <button id="iAttak" class="btn btn-danger">J'attaque</button>
        <div class="lifeNotifier hidden">
          <span>
            <progress value="" max="100" class="progress-bar " id="lifeBar"></progress>
          </span>
        </div><br><br>
        <select class="ennemi form-control" id="enemiesList">
          <?php
            for($i=0;$i<count($all);$i++) {?>
              <option value="<?=$all[$i]->getId()?>"><?=$all[$i]->getNom()?></option>
           <?php } ?>
        </select>
        <audio id="songsPlayer">
          <source src="">
        </audio>
      </div>
    </div>
  <footer class="col-md-10 col-md-offset-1">
    Copyright Mai 2018 -- Sidy Mbengue email:sidymbengue25@gmail.com<br>
    compte github : https://github.com/sidymbengue25
 </footer>
</body>
</html>
