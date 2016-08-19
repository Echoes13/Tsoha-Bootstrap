<?php

class Pokemon extends BaseModel {
	
	public $nr, $name, $type1, $type2, $description;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('validate_nr', 'validate_name');
	}


	//Pokemonin tallentaminen

	public function save() {
		$query = DB::connection()->prepare('INSERT INTO Pokemon(nr, name, type1, type2, description) VALUES (:nr, :name, :type1, :type2, :description) RETURNING nr');
		$query->execute(array(
			'nr' => $this->nr,
			'name' => $this->name,
			'type1' => $this->type1,
			'type2' => $this->type2,
			'description' => $this->description
			));
		$row = $query->fetch();
	}


	//Pokemonin tietojen muokkaaminen

	public function update() {
		$query = DB::connection()->prepare('UPDATE Pokemon SET name =:name, type1 =:type1, type2 =:type2, description =:description WHERE nr =:nr');
		$query->execute(array(
			'nr' => $this->nr,
			'name' => $this->name,
			'type1' => $this->type1,
			'type2' => $this->type2,
			'description' => $this->description
			));
		$row = $query->fetch();
	}


	//Pokemonin tietojen validointi

	public function validate_name() {
		return parent::validate_name_length($this->name, 4, 10);
	}

	public function validate_nr() {
		$errors = array();
      
      	if($this->nr == null){
        	$errors[] = 'Aseta Pokémonille numero!';
        	return $errors;
      	}

      	if ($this->find($this->nr)){
        	$errors[] = 'Numeroa käyttävä Pokémon on jo olemassa!';
      	}

      return $errors;
	}


	//Pokemonin poistaminen tietokannasta

	public function destroy() {
		//Kaikki omistetut pokémonit
		$query = DB::connection()->prepare('DELETE FROM OwnedPokemon WHERE pokemon_id =:nr');
		$query->execute(array('nr' => $this->nr));

		//Kaikki tämän pokémonin pesät
		$query = DB::connection()->prepare('DELETE FROM Pokenest WHERE pokemon_id =:nr');
		$query->execute(array('nr' => $this->nr));

		//Lopuksi itse pokémon
		$query = DB::connection()->prepare('DELETE FROM Pokemon WHERE nr =:nr');
		$query->execute(array('nr' => $this->nr));
	}


	//Pokemonien etsimiseen liittyvät metodit

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Pokemon ORDER BY nr');
		$query->execute();
		$rows = $query->fetchAll();
		$pokemons = array();

		foreach($rows as $row){
			$pokemons[] = new Pokemon(array(
				'nr' => $row['nr'],
				'name' => $row['name'],
				'type1' => $row['type1'],
				'type2' => $row['type2'],
				'description' => $row['description']
				));
		}

		return $pokemons;
	}

	public static function find($nr){
		$query = DB::connection()->prepare('SELECT * FROM Pokemon WHERE nr =:nr LIMIT 1');
		$query->execute(array('nr' => $nr));
		$row = $query->fetch();

		if($row){
			$pokemon = new Pokemon(array(
				'nr' => $row['nr'],
				'name' => $row['name'],
				'type1' => $row['type1'],
				'type2' => $row['type2'],
				'description' => $row['description']
				));

			return $pokemon;
		}

		return null;
	}

	public static function findType($type){
		$query = DB::connection()->prepare('SELECT * FROM Pokemon WHERE type1 =:type OR type2 =:type ORDER BY nr');
		$query->execute(array('type' => $type));
		$rows = $query->fetchAll();
		$pokemons = array();

		foreach($rows as $row){
			$pokemons[] = new Pokemon(array(
				'nr' => $row['nr'],
				'name' => $row['name'],
				'type1' => $row['type1'],
				'type2' => $row['type2'],
				'description' => $row['description']
				));
		}

		return $pokemons;
	}


	//Antaa listan mahdollisista pokémon-tyypeistä

	public static function typeList() {
		$types = array('bug', 'dark', 'dragon', 'electric', 'fairy', 'fighting', 'fire', 'flying', 'ghost', 'grass', 'ground', 'ice', 'normal', 'poison', 'psychic', 'rock', 'steel', 'water');

		return $types;
	}
}