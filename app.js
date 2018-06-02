function MyGameEngine(req,val){
  var xhr=new XMLHttpRequest();
  xhr.open('GET','gameRouter.php?'+req+'='+val,true);
  xhr.onload=function(){
    $data=xhr.responseText;
    if(req==='new'){
      var myCharacter=document.querySelector('.myCharacter');
      myCharacter.innerText+=' '+$data;
    }
    else if(req==='choose'){
      var myCharacter=document.querySelector('.myCharacter');
    }
  };
  xhr.send();
}
function hideChoices(){
  var choices=[].slice.call(document.querySelectorAll('.choices'));
  choices.forEach(function(elem){
    elem.classList.add('hidden');
  });
}
/**
 * Input permettant de choisir un character
 * @type {HTMLElement}
 */
var choose=document.querySelector('.choose');
/**
 * Input permettant de créer un character
 * @type {HTMLElement}
 */
var create=document.querySelector('.create');
//Boutons de choix initial du joueur
var choosePersonnage=document.getElementById('choosePersonnage');
var createPersonnage=document.getElementById('createPersonnage');
//boutton de création
var createMine=document.querySelector('#createMine');
choosePersonnage.onclick=function(){
  hideChoices();
  choose.classList.remove('hidden');
};
createPersonnage.onclick=function(){
  hideChoices();
  create.classList.remove('hidden');
};
createMine.onclick=function(){
  var val=document.querySelector('#nom').value;
  document.querySelector('#nom').value='';
  MyGameEngine('new',val);
  document.querySelector('.main-content1').classList.add('hidden');
  document.querySelector('.main-content2').classList.remove('hidden');
};
