var lecteur=document.querySelector('#lecteurAudio');
var btnPlayPause=document.querySelector('.play-pause img');
var barProgression=document.querySelector('#lecteurBarProgression');
var barTotale=document.querySelector('#lecteurBarTotale');
var sons=document.querySelectorAll('.sonMp3');
var idSon=0,idSonPre=0;
var lecteurTitre=document.querySelector('#lecteurInfosTitre');
var lecteurArtiste=document.querySelector('#lecteurInfosArtiste');
var champDuree=document.querySelector('#lecteurDuree');
var champEcoule=document.querySelector('#lecteurTimeEcoule');
var equaliseurPrinci=document.querySelector('.lecteurEqualiseurPrinci');

function play(){
	var son=sons[idSon];
	var sonPre=sons[idSonPre];
	equaliseurPrinci.style.display='inline-block';
	son.querySelector('.lecteurEqualiseur').style.display='inline-block';
	if(idSon!=idSonPre){
		sonPre.querySelector('.lecteurEqualiseur').style.display='none';
	}
	lecteurTitre.innerHTML=son.querySelector('.sonTitre').innerHTML;
	lecteurArtiste.innerHTML=son.querySelector('.sonArtiste').innerHTML;
	btnPlayPause.parentNode.id="commandePause"
	btnPlayPause.src='images/lecteur/pause.png';
	lecteur.play();
	
}
function pause(){
	btnPlayPause.parentNode.id="commandePlay";
	btnPlayPause.src='images/lecteur/play.png';
	lecteur.pause();
}
function timeFormat(time){
	var minutes=Math.floor(time/60);
	var secondes=Math.floor(time%60)
	if(minutes<10){minutes='0'+minutes;}
	if(secondes<10){secondes='0'+secondes;}
	return minutes+' : '+secondes;
}
function precedent(cond=true){
	if(cond){
		idSonPre=idSon;
	}
	
	idSon--;
	if(idSon<0){
		idSon=sons.length-1;
	}
	lecteur.src=sons[idSon].dataset.audio;
	play();
}
function suivant(){
	idSonPre=idSon;
	idSon++;
	if(idSon>sons.length-1){
		idSon=0;
	}
	lecteur.src=sons[idSon].dataset.audio;
	play();
}
function progression(lecteur){
	var duration = lecteur.duration; // Durée totale
	var time = lecteur.currentTime; // Temps écoulé
	var fraction = time / duration;
	var percent = Math.ceil(fraction * 100);
	barProgression.style.width = percent + '%';
	champEcoule.innerHTML=timeFormat(lecteur.currentTime);
	if(time>=duration){
		suivant();
	}
	if(champDuree.innerHTML="-- : --"){
		champDuree.innerHTML=timeFormat(lecteur.duration);
	}
}

barTotale.addEventListener('click',function(e){
	var position=e.clientX-this.offsetParent.offsetLeft-45;
	var largeur=this.offsetWidth;
	var fraction=position/largeur;
	var percent = Math.ceil(fraction * 100);
	lecteur.currentTime=lecteur.duration*fraction;
	barProgression.style.width=percent+'%';
	
},false);

var btnCommandes=document.querySelectorAll('.lecteurCommande');
for(var i=0,c=btnCommandes.length; i<c;i++){
	

	btnCommandes[i].onclick=function(){
		btnCommande=this
		switch(btnCommande.id){
			case  'commandePlay':
				play();
			break;
			case  'commandePause':
				pause();
			break;
			case  'commandeSuivant':
				suivant();
			break;
			case  'commandePrecedent':
				suivant();
			break;
		}
	}
}

for(var i=0,c=sons.length;i<c;i++){
	sons[i].dataset.numero=i;
	sons[i].onclick=function(){
		idSonPre=idSon;
		idSon=parseInt(this.dataset.numero)+1;
		precedent(false);
	}
}