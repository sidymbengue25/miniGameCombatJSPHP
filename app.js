/**
 * Copyright Mai 2018 -- Sidy Mbengue email:sidymbengue25@gmail.com
 * compte github : https://github.com/sidymbengue25
 */


/**
 * Elle permet d'initialiser les requête AJAX ainsi elle se charger d'adapter la vue pour l'utilisateur
 * @param {string} req le type de requête à envoyer au rooter pour qu'il lui envoie les infos qu'elle a besoin
 * @param {string/number} val  la valeur de la requête: ce dont a besoin le rooter pour interagir avec le ManagerPersonnage
 */
function MyGameEngine(req,val){
  let xhr=new XMLHttpRequest();
  xhr.open('GET','gameRouter.php?'+req+'='+val,true);
  xhr.onload=function(){
    let data=xhr.responseText;
    if(req==='new'||req==='chooseMine'){
      let myCharacter=document.querySelector('.myCharacter');
      myCharacter.innerText+=' '+data;
    }else{
      if(data>0){
      //Il est toujours en vie
        idPlayer.src='songs/crying.mp3';
        lifeBar.value=data;
        playTheSoung(idPlayer);
      }else{
      //Il est mort
        idPlayer.src='songs/see you again.mp3';
        playTheSoung(idPlayer);
        childOfLifeNotifier.classList.add('hidden');
        lifeNotifier.appendChild(restInPeaceImg);
        let deadOne=selectCharacterOnOptions('enemiesList');
        let enemiesList=document.querySelector('#enemiesList');
        enemiesList.removeChild(deadOne);
      }
    }
  };
  xhr.send();
};
/**
 * Désactiver les boutons de choix
 */
function hideChoices(){
  let choices=[].slice.call(document.querySelectorAll('.choices'));
  choices.forEach((elem)=>{
    elem.classList.add('hidden');
  });
}
/**
 * Pour switcher entre les div
 */
function divHider(elem){
  if(elem==='show1'){
    document.querySelector('.main-content1').classList.remove('hidden');
    document.querySelector('.main-content2').classList.add('hidden');
  }else{
    document.querySelector('.main-content1').classList.add('hidden');
    document.querySelector('.main-content2').classList.remove('hidden');
  }
}
/**
 * Elle permet de renvoyer le personnage selectionné
 * @param  {string} selectElementId la valeur de l'attribut id de l'élément HTML <select>
 * @return {HTMlElement}                 l'option sélectionné
 */
function selectCharacterOnOptions(selectElementId){
  let selectedIndex=document.querySelector('#'+selectElementId).options.selectedIndex;
  return document.querySelector('#'+selectElementId).options[selectedIndex];
}
function showLifeNotifier(){
  lifeNotifier.classList.remove('hidden');
}
/**
 * Input permettant de choisir un character
 * @type {HTMLElement}
 */
let choose=document.querySelector('.choose');
/**
 * Input permettant de créer un character
 * @type {HTMLElement}
 */
let create=document.querySelector('.create');
let lifeBar=document.querySelector('#lifeBar');
let lifeNotifier=document.querySelector('.lifeNotifier');
let childOfLifeNotifier=document.querySelector('.lifeNotifier span');
//Image à afficher si l'ennemi est mort
let restInPeaceImg=new Image();
restInPeaceImg.src='img/RIP.gif';
//Boutons de choix initial du joueur
let choosePersonnage=document.getElementById('choosePersonnage');
let createPersonnage=document.getElementById('createPersonnage');
//Etapes de création de joueur
let createMine=document.querySelector('#createMine');
createPersonnage.onclick=function(){
  hideChoices();
  create.classList.remove('hidden');
};
createMine.onclick=function(){
  let val=document.querySelector('#nom').value;
  document.querySelector('#nom').value='';
  MyGameEngine('new',val);
  divHider('show2');
};
//Etapes de sélection de joueur
choosePersonnage.onclick=function(){
  hideChoices();
  choose.classList.remove('hidden');
};
let chooseThis=document.querySelector('#chooseThis');
chooseThis.onclick=function(){
  let selectedOne=selectCharacterOnOptions('characterList');
  MyGameEngine('chooseMine',selectedOne.value);
  divHider('show2');
};
//Combats
let attakButton=document.querySelector('#iAttak');
attakButton.addEventListener('click',()=>{
  let attakedOne=selectCharacterOnOptions('enemiesList');
  MyGameEngine('attak',attakedOne.value);
  document.body.style.backgroundColor='red';
  showLifeNotifier();
  if(childOfLifeNotifier.classList.contains('hidden')){
    childOfLifeNotifier.classList.remove('hidden');
    lifeNotifier.removeChild(restInPeaceImg);

  }
  setTimeout(function(){
  document.body.style.backgroundColor='#fff';
  },200);
},false);
// Soung contaniner
let idPlayer=document.querySelector('#songsPlayer');
/**
 * Elle permet de jouer un audio
 * @param  {string} idPlayer la valeur de l'id de <audio>
 */
function playTheSoung(idPlayer){
    idPlayer.currentTime=0;
    idPlayer.play();
}
