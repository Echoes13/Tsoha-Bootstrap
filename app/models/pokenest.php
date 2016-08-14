<?php

class Pokenest extends BaseModel {
	
	public $pokemon_id, $location, $added;

	public function __construct($attributes){
		parent::__construct($attributes);
	}


	//Pesän lisääminen

	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Pokenest(pokemon_id, location, added) VALUES (:pokemon_id, :location, NOW()) RETURNING added');
		$query->execute(array(
			'pokemon_id' => $this->pokemon_id,
			'location' => $this->location
			));
		$row = $query->fetch();
		$this->added = $row['added'];
	}


	//Pesän poistaminen

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM Pokenest WHERE pokemon_id =:pokemon_id AND location =:location');
		$query->execute(array(
			'pokemon_id' => $this->pokemon_id,
			'location' => $this->location
			));
	}


	//Pesien etsiminen

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Pokenest');
		$query->execute();
		$rows = $query->fetchAll();
		$nests = array();

		foreach($rows as $row){
			$nests[] = new Pokenest(array(
				'pokemon_id' => $row['pokemon_id'],
				'location' => $row['location'],
				'added' => $row['added']
				));
		}

		return $nests;
	}

	public static function findForPokemon($pokemon_id){
		$query = DB::connection()->prepare('SELECT * FROM Pokenest WHERE pokemon_id =:pokemon_id');
		$query->execute(array('pokemon_id' => $pokemon_id));
		$rows = $query->fetchAll();
		$nests = array();

		foreach($rows as $row){
			$nests[] = new Pokenest(array(
				'pokemon_id' => $row['pokemon_id'],
				'location' => $row['location'],
				'added' => $row['added']
				));
		}

		return $nests;
	}
}