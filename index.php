<?php 

require 'core/LecteurComponent.php';
$son=LecteurComponent::lecteurOne('database/lecteur.sqlite');
$sons=LecteurComponent::lecteur('database/lecteur.sqlite');

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/lecteurMp3.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
  
	<div class="container">
		<div class="col-md-4">
			<div id="lecteurMp3" style="box-shadow: 1px 2px 30px 3px rgba(0,0,0,0.2)">
			        <audio src="<?=$son->file;?>" id="lecteurAudio" ontimeupdate="progression(this)"></audio>
			        <div id="lecteurInfos" style="margin-bottom: 5px;">
			          <div><img src="images/lecteur/pochettes/pochette2.jpg" align="bottom" alt=""></div>
			          <div>
			            <b><span id="lecteurInfosTitre"><?=$son->artiste;?></span></b><br>
			            <span id="lecteurInfosArtiste"><?=$son->titre;?></span><br>

			          </div>
			          <div>
			            <img class="lecteurEqualiseurPrinci" style="display: none;width: 40px;position: absolute;top: 10px;right: 80px;" src="images/lecteur/logo/equaliseur2.gif"  width="10" align="top" alt="">
			          </div>
			          <img src="images/lecteur/logo/liste.png" style="width: 30px;position: absolute;top: 25px;right: 20px;"  alt="">
			        </div>
			        <div id="lecteurBan">
			          <div class="lecteurFiltre"></div>
			          <div id="banText">
			            <span class="titreSpace" style="font-family: roboto;font-weight: 100;margin: 0px;padding: 0px;font-size: 17px;">Lecteur <b>mp3</b></span><br>
			            Tous les titres<br><br>
			            <div>
			              <div id="lecteurTimeEcoule">-- : --</div>
			              <div id="lecteurDuree">-- : --</div>
			            </div>
			          </div>
			        </div>
			        <div id="lecteurBar">
			          <div id="lecteurBarTotale">
			            <div id="lecteurBarProgression"></div>
			          </div>
			        </div><br>
			        <div id="lecteurCommandes" class="text-center">
			          <div class="lecteurCommande" id="commandePrecedent">
			            <img src="images/lecteur/precedent.png" alt="">
			          </div>
			          <div class="lecteurCommande play-pause" id="commandePlay" style="background: white;z-index: 5">
			            <img src="images/lecteur/play.png" alt="">
			          </div>
			          <div class="lecteurCommande" id="commandeSuivant">
			            <img src="images/lecteur/suivant.png" alt="">
			          </div>
			        </div>
			        <div id="lecteurOmbre" style="margin: auto;box-shadow: 2px 10px 30px 6px rgba(0,0,0,0.5);width: 150px;position: relative;top: -20px;z-index: 1">
			        	
			        </div><br>
			        <div id="listeSonsMp3">
			          <?php 
			            $i=0;
			            foreach ($sons as $son) {
			              $i++;
			              if($i==1){
			          ?>
			            <div class="sonMp3"  data-audio="<?=$son->file;?>">
			              <div class="col-xs-6"><img class="lecteurEqualiseur" style="display: inline-block;" src="images/lecteur/logo/equaliseur2.gif"  width="20" align="top" alt=""><span class="sonArtiste "><?=$son->artiste;?></span></div>
			              <div class="sonTitre col-xs-6"><?=$son->titre;?></div>
			            </div>
			          <?php
			              }else{
			          ?>
			            <div class="sonMp3"  data-audio="<?=$son->file;?>">
			              <div class="col-xs-6"><img class="lecteurEqualiseur"  src="images/lecteur/logo/equaliseur2.gif"  width="20" align="top" alt="">
				              <span class="sonArtiste ">
				              	<?php 
				              		if(strlen($son->artiste)>=14){
				              			echo substr($son->artiste, 0,12).'<span class="lecteurTextEfface">'.substr($son->artiste, 12,1).'</span>'.'<span class="lecteurTextEfface1">'.substr($son->artiste, 13,1).'</span>'.'<span class="lecteurTextEfface2">'.substr($son->artiste, 14,1).'</span>';
				              		}else{
				              			echo $son->artiste;
				              		}
				              	?>
				              </span>
			              </div>
			              <div class="sonTitre col-xs-6">
			              	<?php 
				              		if(strlen($son->titre)>=14){
				              			echo substr($son->titre, 0,11).'<span class="lecteurTextEfface">'.substr($son->titre, 11,1).'</span>'.'<span class="lecteurTextEfface1">'.substr($son->titre, 12,1).'</span>'.'<span class="lecteurTextEfface2">'.substr($son->titre, 13,1).'...</span>';
				              		}else{
				              			echo $son->titre;
				              		}
				              	?>
			              </div>
			            </div>
			          <?php
			              }
			          ?>
			            
			          <?php
			            }
			          ?>
			        </div><br>
			        <div></div>
			        <br>
			      </div>
				</div>
		</div>
	</div>
  <script type="text/javascript" src="js/lecteurMp3.js"></script>

</body>
</html>