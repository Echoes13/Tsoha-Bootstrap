<?php

class OwnedPokemon extends BaseModel {
	
	public $trainer_id, $id, $pokemon_id, $nick, $name, $type1, $type2;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_caught', 'validate_nick', 'validate_pokemon');
	}


	//Omistetun pokémonin tallentaminen

	public function save() {
		$query = DB::connection()->prepare('INSERT INTO OwnedPokemon(trainer_id, id, pokemon_id, nick) VALUES (:trainer_id, :id, :pokemon_id, :nick) RETURNING id');
		$query->execute(array(
			'trainer_id' => $this->trainer_id,
			'id' => $this->id,
			'pokemon_id' => $this->pokemon_id,
			'nick' => $this->nick
			));
		$row = $query->fetch();
	}


	//Omistetun pokémonin tietojen muokkaaminen

	public function update() {
		$query = DB::connection()->prepare('UPDATE OwnedPokemon SET pokemon_id =:pokemon_id, nick =:nick WHERE trainer_id =:trainer_id AND id =:id');
		$query->execute(array(
			'trainer_id' => $this->trainer_id,
			'id' => $this->id,
			'pokemon_id' => $this->pokemon_id,
			'nick' => $this->nick
			));
		$query->fetch();
	}


	//Tietojen validointi

	public function validate_nick() {
		return parent::validate_name_length($this->nick, 1, 10);
	}

	public function validate_pokemon() {
		$errors = array();
      
      	if(!Pokemon::find($this->pokemon_id)){
        	$errors[] = 'Valittua Pokémonia ei löydy!';
      	}

      return $errors;
	}

	public function validate_caught() {
		$errors = array();
      
      	if($this->find($this->trainer_id, $this->id)){
        	$errors[] = 'Tarkista napattujen pokémonien määrä ennen kuin lisäät uusia pokémoneja listaasi!';
      	}

      return $errors;
	}


	//Omistetun pokémonin poistaminen tietokannasta

	public function destroy() {
		$query = DB::connection()->prepare('DELETE FROM OwnedPokemon WHERE trainer_id =:trainer_id AND id =:id');
		$query->execute(array('trainer_id' => $this->trainer_id, 'id' => $this->id));
	}


	//Omistetun pokémonin etsimiseen liittyvät metodit

	public static function all($trainer_id){
		$query = DB::connection()->prepare('SELECT OwnedPokemon.trainer_id, OwnedPokemon.id, OwnedPokemon.pokemon_id, OwnedPokemon.nick, Pokemon.name, Pokemon.type1, Pokemon.type2 FROM OwnedPokemon INNER JOIN Pokemon ON OwnedPokemon.pokemon_id = Pokemon.nr WHERE OwnedPokemon.trainer_id =:trainer_id ORDER BY Pokemon.nr, OwnedPokemon.nick');
		$query->execute(array('trainer_id' => $trainer_id));
		$rows = $query->fetchAll();
		$pokemons = array();

		foreach($rows as $row){
			$pokemons[] = new OwnedPokemon(array(
				'trainer_id' => $row['trainer_id'],
				'id' => $row['id'],
				'pokemon_id' => $row['pokemon_id'],
				'nick' => $row['nick'],
				'name' => $row['name'],
				'type1' => $row['type1'],
				'type2' => $row['type2']
				//'cp' => $row['cp']
				));
		}

		return $pokemons;
	}


	public static function find($trainer_id, $id){
		$query = DB::connection()->prepare('SELECT OwnedPokemon.trainer_id, OwnedPokemon.id, OwnedPokemon.pokemon_id, OwnedPokemon.nick, Pokemon.name, Pokemon.type1, Pokemon.type2 FROM OwnedPokemon INNER JOIN Pokemon ON OwnedPokemon.pokemon_id = Pokemon.nr WHERE trainer_id =:trainer_id AND id =:id LIMIT 1');
		$query->execute(array('trainer_id' => $trainer_id,'id' => $id));
		$row = $query->fetch();

		if($row){
			$pokemon = new OwnedPokemon(array(
				'trainer_id' => $row['trainer_id'],
				'id' => $row['id'],
				'pokemon_id' => $row['pokemon_id'],
				'nick' => $row['nick'],
				'name' => $row['name'],
				'type1' => $row['type1'],
				'type2' => $row['type2']
			//	'cp' => $row['cp']
				));

			return $pokemon;
		}

		return null;
	}

	public static function findType($trainer_id, $type){
		$query = DB::connection()->prepare('SELECT OwnedPokemon.trainer_id, OwnedPokemon.id, OwnedPokemon.pokemon_id, OwnedPokemon.nick, Pokemon.name, Pokemon.type1, Pokemon.type2 FROM OwnedPokemon INNER JOIN Pokemon ON OwnedPokemon.pokemon_id = Pokemon.nr WHERE OwnedPokemon.trainer_id =:trainer_id AND (Pokemon.type1 =:type OR Pokemon.type2 =:type) ORDER BY Pokemon.nr, OwnedPokemon.nick');
		$query->execute(array('trainer_id' => $trainer_id, 'type' => $type));
		$rows = $query->fetchAll();
		$pokemons = array();

		foreach($rows as $row){
			$pokemons[] = new OwnedPokemon(array(
				'trainer_id' => $row['trainer_id'],
				'id' => $row['id'],
				'pokemon_id' => $row['pokemon_id'],
				'nick' => $row['nick'],
				'name' => $row['name'],
				'type1' => $row['type1'],
				'type2' => $row['type2']
				//'cp' => $row['cp']
				));
		}

		return $pokemons;
	}


	public static function find_max($trainer_id){
		$query = DB::connection()->prepare('SELECT MAX(OwnedPokemon.id) FROM OwnedPokemon WHERE trainer_id =:trainer_id');
		$query->execute(array('trainer_id' => $trainer_id));
		$value = $query->fetch();

		return $value[0];
	}
}