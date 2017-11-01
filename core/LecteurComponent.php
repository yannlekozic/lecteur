<?php 



class LecteurComponent{

	/**
	 * Permet d'afficher la liste de lecture
	 * @param string $baseChemin le chemin de la base de donnée
	 */
	static function lecteur($baseChemin){
		$base=new PDO("sqlite:".$baseChemin);
		$req=$base->query('SELECT * FROM sons');
		$req->setFetchMode(PDO::FETCH_OBJ);
		$res=$req->fetchAll();
		$req->closeCursor();
		return $res;
	}

	/**
	 * Affiche le premier son
	 * @param string $baseChemin le chemin de la base de donnée
	 */
	static function lecteurOne($baseChemin){
		$base=new PDO("sqlite:".$baseChemin);
		$req=$base->query('SELECT * FROM sons limit 0,1');
		$req->setFetchMode(PDO::FETCH_OBJ);
		$res=$req->fetch();
		$req->closeCursor();
		return $res;
	}
}

?>