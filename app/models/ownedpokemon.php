<?php

class OwnedPokemon extends BaseModel {
	
	public $trainer_id, $id, $pokemon_id, $nick;

	public function __construct($attributes){
		parent::__construct($attributes);
	}


	public static function allTrainers(){
		$query = DB::connection()->prepare('SELECT * FROM OwnedPokemon');
		$query->execute();
		$rows = $query->fetchAll();
		$pokemons = array();

		foreach($rows as $row){
			$pokemons[] = new OwnedPokemon(array(
				'trainer_id' => $row['trainer_id'],
				'id' => $row['id'],
				'pokemon_id' => $row['pokemon_id'],
				'nick' => $row['nick']
				));
		}

		return $pokemons;
	}


	public static function all($trainer_id){
		$query = DB::connection()->prepare('SELECT * FROM OwnedPokemon WHERE trainer_id =:trainer_id');
		$query->execute(array('trainer_id' => $trainer_id));
		$rows = $query->fetchAll();
		$pokemons = array();

		foreach($rows as $row){
			$pokemons[] = new OwnedPokemon(array(
				'trainer_id' => $row['trainer_id'],
				'id' => $row['id'],
				'pokemon_id' => $row['pokemon_id'],
				'nick' => $row['nick']
				));
		}

		return $pokemons;
	}


	public static function find($trainer_id, $id){
		$query = DB::connection()->prepare('SELECT * FROM OwnedPokemon WHERE trainer_id =:trainer_id AND id =:id LIMIT 1');
		$query->execute(array('trainer_id' => $trainer_id,'id' => $id));
		$row = $query->fetch();

		if($row){
			$pokemon = new OwnedPokemon(array(
				'trainer_id' => $row['trainer_id'],
				'id' => $row['id'],
				'pokemon_id' => $row['pokemon_id'],
				'nick' => $row['nick']
				));

			return $pokemon;
		}

		return null;
	}
}